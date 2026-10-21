document.documentElement.classList.add("js");

/* Два уровня картинок: сначала пробуем настоящее фото из /images,
   если файла ещё нет — подставляем оформленную заглушку из /images/placeholder.
   Чтобы заменить картинку, просто положите файл с тем же именем в /images. */
document.querySelectorAll("img.media").forEach(function (img) {
  function ok() { img.hidden = false; img.parentElement.classList.add("has-img"); }
  function fail() {
    var ph = img.getAttribute("data-ph");
    if (ph && img.getAttribute("data-fallback") !== "1") {
      img.setAttribute("data-fallback", "1");
      img.src = ph;
      return;
    }
    img.hidden = true;
    img.parentElement.classList.remove("has-img");
  }
  img.addEventListener("load", ok);
  img.addEventListener("error", fail);
  if (img.complete) { img.naturalWidth > 0 ? ok() : fail(); }
});

/* ---- Таймлайн: положение на странице показывается как таймкод ролика,
       метки разделов работают как главы — по ним можно перематывать. ---- */
var reduce = matchMedia("(prefers-reduced-motion: reduce)").matches;
var tl = document.getElementById("tl");
var tlFill = document.getElementById("tlFill");
var tlHead = document.getElementById("tlHead");
var tlTime = document.getElementById("tlTime");
var tlMarks = document.getElementById("tlMarks");
var phone = document.querySelector(".phone");
var reelsBlock = document.getElementById("reels");
var reelCards = [].slice.call(document.querySelectorAll(".reels .rl"));

/* Подписи глав и шаблон названия метки — из разметки, где они взяты
   из словаря: зашитые здесь по-русски, они звучали и на /az/, и на /en/.
   Русские остаются запасным вариантом на случай битого атрибута. */
var TITLES = { services: "Услуги", portfolio: "Портфолио", reels: "Reels", about: "О студии", process: "Процесс", price: "Цены", blog: "Блог", faq: "Вопросы", contact: "Контакты" };
try { var tlT = JSON.parse(tlMarks.getAttribute("data-titles") || "null"); if (tlT) TITLES = tlT; } catch (e) { /* остаёмся на русских */ }
var TL_GO = tlMarks.getAttribute("data-go") || "Перейти к разделу «{s}»";
var chapters = Object.keys(TITLES).map(function (id) { return { id: id, el: document.getElementById(id) }; }).filter(function (c) { return c.el; });

function maxScroll() { return Math.max(1, document.documentElement.scrollHeight - innerHeight); }
function fmt(s) { var m = Math.floor(s / 60), x = Math.floor(s % 60); return (m < 10 ? "0" : "") + m + ":" + (x < 10 ? "0" : "") + x; }
var DUR = 180;

function layout() {
  DUR = Math.min(420, Math.max(90, Math.round(document.documentElement.scrollHeight / 68)));
  var max = maxScroll();
  tlMarks.innerHTML = "";
  chapters.forEach(function (c) {
    var b = document.createElement("button");
    b.type = "button";
    b.className = "tl-mark";
    b.style.left = Math.min(100, (c.el.offsetTop / max) * 100) + "%";
    b.setAttribute("data-id", c.id);
    /* Подстановка функцией: строкой replace() понял бы «$&» в названии как шаблон. */
    b.setAttribute("aria-label", TL_GO.replace("{s}", function () { return TITLES[c.id]; }));
    var s = document.createElement("span");
    s.textContent = TITLES[c.id];
    b.appendChild(s);
    b.addEventListener("click", function () {
      c.el.scrollIntoView({ behavior: reduce ? "auto" : "smooth", block: "start" });
    });
    tlMarks.appendChild(b);
  });
}

var ticking = false;
function frame() {
  ticking = false;
  var p = Math.min(1, Math.max(0, scrollY / maxScroll()));
  tlFill.style.width = p * 100 + "%";
  tlHead.style.left = p * 100 + "%";
  tlTime.textContent = fmt(p * DUR) + " / " + fmt(DUR);
  tl.classList.toggle("on", scrollY > 260);

  var activeId = null;
  chapters.forEach(function (c) {
    if (c.el.getBoundingClientRect().top <= innerHeight * 0.35) activeId = c.id;
  });
  [].forEach.call(tlMarks.children, function (b) {
    b.setAttribute("aria-current", b.getAttribute("data-id") === activeId ? "true" : "false");
  });

  if (reduce) return;
  if (phone) phone.style.transform = "translateY(" + -Math.min(26, scrollY * 0.06) + "px)";
  if (reelsBlock && reelCards.length) {
    var r = reelsBlock.getBoundingClientRect();
    var t = Math.max(-1, Math.min(1, (innerHeight * 0.5 - r.top - r.height * 0.5) / innerHeight));
    reelCards.forEach(function (card, i) {
      card.style.setProperty("--py", (i % 2 ? t * 24 : t * -12) + "px");
    });
  }
}
function onScroll() { if (!ticking) { ticking = true; requestAnimationFrame(frame); } }
addEventListener("scroll", onScroll, { passive: true });
addEventListener("resize", function () { layout(); onScroll(); });
layout();
frame();

var io = new IntersectionObserver(function (es) {
  es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add("in"); io.unobserve(e.target); } });
}, { rootMargin: "0px 0px -7% 0px", threshold: 0.05 });
document.querySelectorAll(".rv").forEach(function (el) { io.observe(el); });

var burger = document.getElementById("burger");
var drawer = document.getElementById("drawer");
/* Шторка непрозрачно накрывает страницу, но за ней оставалось ~70 фокусируемых
   элементов. inert гасит их целиком — включая шапку, которая лежит вне main. */
var behind = [".skip", ".wm", ".nav .menu", ".nav .lang", ".pill.nav-cta", "main", "footer.site"]
  .map(function (s) { return document.querySelector(s); }).filter(Boolean);
var lastFocus = null;
var menuScrollY = 0;
function setMenu(open) {
  drawer.classList.toggle("open", open);
  document.body.classList.toggle("menu-open", open);
  burger.setAttribute("aria-expanded", open ? "true" : "false");
  /* Подписи берём из разметки: раньше они были зашиты по-русски и на /az/
     и /en/ кнопка после первого нажатия начинала говорить по-русски. */
  burger.setAttribute("aria-label", open ? (burger.dataset.close || "Закрыть меню") : (burger.dataset.open || "Открыть меню"));
  /* Прокрутку страницы под шторкой глушим не через overflow:hidden — на iOS
     Safari он не держит, страница всё равно едет. Фиксируем body и компенсируем
     сдвиг отрицательным top, а при закрытии возвращаем позицию: иначе человек
     закроет меню и окажется в начале страницы. */
  if (open) {
    menuScrollY = window.scrollY || document.documentElement.scrollTop || 0;
    document.body.style.position = "fixed";
    document.body.style.top = -menuScrollY + "px";
    document.body.style.left = "0";
    document.body.style.right = "0";
  } else if (document.body.style.position === "fixed") {
    document.body.style.position = "";
    document.body.style.top = "";
    document.body.style.left = "";
    document.body.style.right = "";
    /* html{scroll-behavior:smooth} делал возврат плавным проездом от начала
       страницы: мелькал первый экран, и всё ехало вниз почти секунду.
       Плавность снимаем на один вызов — якорные ссылки её сохраняют. */
    var root = document.documentElement;
    root.style.scrollBehavior = "auto";
    window.scrollTo(0, menuScrollY);
    root.style.scrollBehavior = "";
  }
  behind.forEach(function (el) { if (open) { el.setAttribute("inert", ""); } else { el.removeAttribute("inert"); } });
  if (open) {
    lastFocus = document.activeElement;
    /* Фокус не встаёт, пока элемент ещё visibility:hidden. Чтение offsetHeight
       принудительно применяет стиль; кадр запаса — на случай отложенной отрисовки. */
    var first = drawer.querySelector("a, button");
    if (first) {
      void drawer.offsetHeight;
      first.focus();
      if (document.activeElement !== first) requestAnimationFrame(function () { first.focus(); });
    }
  } else {
    (lastFocus && lastFocus.focus ? lastFocus : burger).focus();
    lastFocus = null;
  }
}
burger.addEventListener("click", function () { setMenu(!drawer.classList.contains("open")); });
drawer.querySelectorAll("a").forEach(function (a) { a.addEventListener("click", function () { setMenu(false); }); });
/* Только открытое меню: иначе Escape в поле формы (закрыть автоподстановку)
   выдёргивал фокус на кнопку меню. */
addEventListener("keydown", function (e) { if (e.key === "Escape" && drawer.classList.contains("open")) setMenu(false); });

/* Переключение формата на «мониторе». Список — вкладки, а не четыре
   независимых тумблера: выбран всегда ровно один. */
var vfList = document.getElementById("vfList"), vfNow = document.getElementById("vfNow");
if (vfList && vfNow) {
  var tabs = [].slice.call(vfList.querySelectorAll(".vfr"));
  var cur = Math.max(0, tabs.indexOf(vfList.querySelector('.vfr[aria-selected="true"]')));
  /* Роль tab обещает диктору стрелки, поэтому в обходе Tab стоит только
     выбранная вкладка, а между вкладками ходят стрелками. В разметке
     tabindex не ставим: без скрипта вкладки ничего не делают. */
  function rove() { tabs.forEach(function (b, i) { b.tabIndex = i === cur ? 0 : -1; }); }
  rove();

  var pick = function (btn) {
    if (!btn || btn.getAttribute("aria-selected") === "true") return;
    tabs.forEach(function (b) { b.setAttribute("aria-selected", b === btn ? "true" : "false"); });
    cur = tabs.indexOf(btn);
    rove();
    vfNow.textContent = btn.querySelector("b").textContent;
    var shot = document.getElementById("vfShot"), src = btn.getAttribute("data-img");
    if (shot && src && shot.getAttribute("src") !== src) {
      shot.classList.add("cut");
      setTimeout(function () { shot.src = src; shot.classList.remove("cut"); }, 180);
    }
    showVideo();
    if (typeof start === "function") start(btn.getAttribute("data-sub"));
  };
  vfList.addEventListener("click", function (e) { pick(e.target.closest(".vfr")); });
  vfList.addEventListener("keydown", function (e) {
    var n = tabs.length, k = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 }[e.key], to;
    if (k) to = (cur + k + n) % n;
    else if (e.key === "Home") to = 0;
    else if (e.key === "End") to = n - 1;
    else return;
    e.preventDefault();                   // стрелки не должны заодно прокручивать страницу
    pick(tabs[to]);
    tabs[to].focus();
  });

  /* Демонстрация формата: полосы глав, тикающий таймкод и строка субтитров.
     Никакой подделки под съёмку — показываем ремесло, а не чужой материал. */
  var scr = document.getElementById("vfScr"), cc = document.getElementById("vfCC"),
      bars = document.getElementById("vfBars"), state = document.getElementById("vfState"),
      tc = document.querySelector(".vf-tc");
  var STEP = 2600, lines = [], idx = 0, timer = null, t0 = 0, raf = 0, running = false;
  var mqStill = matchMedia("(prefers-reduced-motion: reduce)");
  var still = mqStill.matches;
  var inView = false, vids = null, paused = false;

  /* Видео ставим, только если оно уместно: при включённом «меньше движения»
     его не создаём вовсе (браузер по этой медиа-функции видео не глушит),
     и не тянем на экономии трафика и медленной сети. */
  var conn = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
  /* 3g сюда не включаем: ролик весит около 140 КБ, это меньше секунды даже
     на полутора мегабитах, а браузеры размечают сеть как 3g слишком охотно. */
  var thin = !!conn && (conn.saveData === true || /^(slow-2g|2g)$/.test(conn.effectiveType || ""));
  function vidOK() { return !still && !thin && !paused; }

  function dropVideos() {
    if (!vids) return;
    vids.forEach(function (v) { if (v) { v.removeAttribute("src"); v.remove(); } });
    vids = null;
    scr.classList.remove("has-vid");
  }

  function makeVideos() {
    if (vids || !vidOK()) return;
    vids = tabs.map(function (b) {
      var u = b.getAttribute("data-vid");
      if (!u) return null;
      var v = document.createElement("video");
      v.className = "vf-vid";
      /* muted и playsinline — именно атрибутами: Safari читает их до загрузки,
         иначе автозапуск без звука не разрешат. autoplay не ставим вообще —
         он отменил бы preload="none" и потянул бы все четыре файла сразу. */
      v.setAttribute("muted", ""); v.setAttribute("playsinline", ""); v.setAttribute("loop", "");
      v.muted = true; v.loop = true; v.playsInline = true;
      v.preload = "none";
      v.setAttribute("aria-hidden", "true");
      var ps = b.getAttribute("data-poster"); if (ps) v.poster = ps;
      v.src = u;
      v.addEventListener("error", dropVideos, { once: true });
      /* Сразу за статичным макетом: тогда ролик кроет его, но остаётся
         под разметкой безопасной зоны и подписями, которые рисует страница. */
      var anchor = document.getElementById("vfShot");
      scr.insertBefore(v, anchor ? anchor.nextSibling : scr.firstChild);
      return v;
    });
    if (!vids.some(Boolean)) { vids = null; return; }
    scr.classList.add("has-vid");
    showVideo();
  }

  function showVideo() {
    if (!vids) return;
    vids.forEach(function (v, i) { if (v) v.classList.toggle("on", i === cur); });
    playCur();
  }

  function playCur() {
    if (!vids || !inView || !vidOK()) return;
    vids.forEach(function (v, i) { if (v && i !== cur) v.pause(); });
    var v = vids[cur];
    if (!v) return;
    var p = v.play();
    /* play() отклоняется при политике автозапуска и при быстрой смене кадра —
       это не ошибка: остаётся постер, и блок выглядит как раньше. */
    if (p && p.catch) p.catch(function () {});
  }

  function pauseVideos() { if (vids) vids.forEach(function (v) { if (v) v.pause(); }); }

  function pad(n, l) { n = String(n); while (n.length < l) n = "0" + n; return n; }
  function driving() {
    var v = vids && vids[cur];
    return !!(v && !v.paused && !v.ended && v.readyState > 2);
  }
  function tick() {
    /* Когда играет ролик, часами служит он сам: главы в видео нарезаны по
       STEP, поэтому склейка попадает ровно на смену субтитра и на полосу главы.
       Свой таймер разошёлся бы с видео за полминуты. */
    var v = vids && vids[cur], drive = driving();
    var ms = drive ? v.currentTime * 1000 : Date.now() - t0;
    var s = Math.floor(ms / 1000);
    tc.textContent = "00:" + pad(Math.floor(s / 60), 2) + ":" + pad(s % 60, 2) + ":" + pad(Math.floor((ms % 1000) / 40), 2);
    if (drive && lines.length) {
      var i = Math.min(lines.length - 1, Math.floor(ms / STEP));
      if (i !== idx) { idx = i; show(); }
    }
    raf = requestAnimationFrame(tick);
  }
  function paintBars() {
    [].forEach.call(bars.children, function (b, i) {
      b.className = i < idx ? "done" : (i === idx ? "run" : "");
    });
  }
  function show() {
    cc.classList.add("cut");
    setTimeout(function () { cc.textContent = lines[idx] || ""; cc.classList.remove("cut"); }, 180);
    paintBars();
  }
  function stop() {
    clearInterval(timer); timer = null; cancelAnimationFrame(raf); raf = 0;
    running = false;
    pauseVideos();
    scr.classList.remove("play"); state.textContent = "stby";
  }
  function start(src) {
    clearInterval(timer); timer = null; cancelAnimationFrame(raf); raf = 0;
    lines = (src || "").split("|");
    idx = 0;
    cc.textContent = lines[0] || "";
    if (still || paused) { running = false; paintBars(); scr.classList.remove("play"); state.textContent = "stby"; return; }
    running = true;
    scr.classList.add("play"); state.textContent = "rec";
    bars.style.setProperty("--vf-step", STEP + "ms");
    t0 = Date.now(); tick(); paintBars();
    timer = setInterval(function () {
      if (driving()) return;          // главы ведёт видео — таймер не вмешивается
      idx += 1;
      if (idx >= lines.length) { idx = 0; t0 = Date.now(); }
      show();
    }, STEP);
  }
  var pickedSub = function () {
    var b = vfList.querySelector('.vfr[aria-selected="true"]') || vfList.querySelector(".vfr");
    return b ? b.getAttribute("data-sub") : "";
  };
  /* Кнопка остановки: движение идёт петлёй дольше пяти секунд, а по WCAG 2.2.2
     у такого контента должен быть способ его прекратить. Делаем её из скрипта,
     чтобы без JS не висел мёртвый орган управления. */
  var osd = document.querySelector(".vf-osd");
  var pp = document.createElement("button");
  pp.type = "button"; pp.className = "vf-pp";
  /* Название постоянное, состояние говорит aria-pressed — так устроена
     кнопка-переключатель. Текст из разметки: зашитый по-русски, он звучал
     и на /az/, и на /en/. */
  pp.setAttribute("aria-label", osd.getAttribute("data-pause") || "Пауза демонстрации");
  function labelPP() {
    pp.setAttribute("aria-pressed", paused ? "true" : "false");
  }
  labelPP();
  pp.addEventListener("click", function () {
    paused = !paused;
    labelPP();
    scr.classList.toggle("off", paused);
    if (paused) { stop(); }
    else { makeVideos(); start(pickedSub()); showVideo(); }
  });
  /* Строка служебных надписей разнесена по краям. Третий элемент вытолкнул бы
     «9:16» в середину, поэтому собираем правую группу явно. */
  var right = document.createElement("span");
  right.className = "vf-osd-r";
  right.appendChild(osd.lastElementChild);
  right.appendChild(pp);
  osd.appendChild(right);

  /* Запускаем сразу, а не по наблюдателю: если наблюдатель по какой-то причине
     не сработает, блок иначе останется мёртвым навсегда. Наблюдатель только
     ставит на паузу за экраном, чтобы таймер не крутился впустую. */
  start(pickedSub());
  if ("IntersectionObserver" in window) {
    new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        inView = e.isIntersecting;
        if (inView) {
          makeVideos();                       // файлы запрашиваем только в зоне видимости
          if (!running) start(pickedSub());
          playCur();
        } else { stop(); }
      });
    }, { threshold: 0.2 }).observe(scr);
  } else {
    inView = true; makeVideos();
  }

  /* Наведение не выбирает таб мгновенно: проезд курсора по списку иначе
     переключал бы кадр четыре раза за полсекунды. */
  if (matchMedia("(hover:hover)").matches) {
    var hv = 0;
    vfList.addEventListener("mouseover", function (e) {
      var b = e.target.closest(".vfr");
      if (!b) return;
      clearTimeout(hv);
      hv = setTimeout(function () { pick(b); }, 120);
    });
    vfList.addEventListener("mouseleave", function () { clearTimeout(hv); });
  }

  /* Режим «меньше движения» можно включить и при открытой странице. */
  var onStill = function () {
    still = mqStill.matches;
    if (still) { stop(); dropVideos(); }
    else if (inView) { makeVideos(); start(pickedSub()); }
  };
  if (mqStill.addEventListener) mqStill.addEventListener("change", onStill);
  else if (mqStill.addListener) mqStill.addListener(onStill);
}

/* ---- Пауза первого экрана. «Телефон» с роликами и бегущая строка идут
       петлёй без конца, а по WCAG 2.2.2 такое движение должно останавливаться.
       Кнопка в разметке скрыта и появляется только со скриптом; при «меньше
       движения» этих анимаций нет вовсе, и кнопка не нужна. ---- */
var heroPP = document.getElementById("heroPP");
if (heroPP && !reduce) {
  heroPP.hidden = false;
  heroPP.addEventListener("click", function () {
    var on = document.documentElement.classList.toggle("still");
    heroPP.setAttribute("aria-pressed", on ? "true" : "false");
  });
}

/* Форма есть не на каждой странице: без проверки скрипт падал бы на внутренних,
   а вместе с ним не запускалось бы всё, что объявлено ниже. */
/* ---- Счётчик в полосе цифр. Число в разметке уже стоит конечное, скрипт
       только проигрывает подъём до него: без JS и при «меньше движения»
       посетитель сразу видит правильное значение. Цифры в .bcell b
       табличные, поэтому ширина при счёте не прыгает. ---- */
(function () {
  var nums = [].slice.call(document.querySelectorAll("[data-count]"));
  if (!nums.length || !("IntersectionObserver" in window)) return;
  if (matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  function run(el) {
    var to = parseInt(el.getAttribute("data-count"), 10);
    if (!isFinite(to) || to <= 0) return;
    var dur = 900, t0 = 0;
    function step(ts) {
      if (!t0) t0 = ts;
      var k = Math.min(1, (ts - t0) / dur);
      k = 1 - Math.pow(1 - k, 3);                 // замедление к концу
      el.textContent = Math.round(to * k);
      if (k < 1) requestAnimationFrame(step);
      else el.textContent = to;                   // ровно то, что было в разметке
    }
    el.textContent = "0";
    requestAnimationFrame(step);
  }

  var cio = new IntersectionObserver(function (es) {
    es.forEach(function (e) {
      if (!e.isIntersecting) return;
      cio.unobserve(e.target);                    // один раз за загрузку
      run(e.target);
    });
  }, { threshold: 0.6 });
  nums.forEach(function (n) { cio.observe(n); });
})();

var leadForm = document.getElementById("lead");
if (leadForm) {
  /* Проверка «человек ли это» одноразовая: после отправки её токен сгорает,
     и в скрытом поле остаётся негодное значение. Если виджет не обновить,
     вторая отправка с той же страницы обречена — сервер ответит «проверка
     не пройдена», и так до перезагрузки. Поэтому после КАЖДОГО ответа,
     удачного или нет, просим виджет выдать новый токен. */
  var hasCaptcha = !!leadForm.querySelector(".cf-turnstile");

  function resetCaptcha() {
    if (!hasCaptcha) return;
    if (window.turnstile && typeof window.turnstile.reset === "function") {
      try { window.turnstile.reset(); } catch (e) { /* виджет ещё не готов */ }
    }
  }

  leadForm.addEventListener("submit", function (e) {
    /* Без скрипта форма уходит обычным POST на /send.php и возвращается
       с ?sent=1 — перехват только ради того, чтобы не перезагружать страницу. */
    e.preventDefault();
    var st = document.getElementById("lead-status");
    var btn = leadForm.querySelector('button[type="submit"]');
    if (btn) btn.disabled = true;
    st.textContent = "…";
    fetch(leadForm.action, {
      method: "POST",
      body: new FormData(leadForm),
      headers: { "X-Requested-With": "fetch" }
    })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        st.textContent = d.message || "";
        if (d.ok) leadForm.reset();
        resetCaptcha();
      })
      .catch(function () {
        /* Сеть не ответила. Без капчи отправляем обычным способом, чтобы
           заявка не потерялась из-за одной неудачной попытки.

           А с капчей так нельзя: токен уже ушёл в неудавшемся запросе и
           мог сгореть на сервере, поэтому повторная отправка тем же полем
           гарантированно получит отказ. Вместо этого обновляем виджет и
           просим человека нажать ещё раз — его текст в полях при этом
           остаётся на месте. */
        if (hasCaptcha) {
          st.textContent = leadForm.getAttribute("data-retry") ||
            "Не получилось отправить. Нажмите ещё раз.";
          resetCaptcha();
        } else {
          leadForm.submit();
        }
      })
      .then(function () { if (btn) btn.disabled = false; });
  });
}

/* ---- Фильтра портфолио на скрипте больше нет: у каждой отрасли своя
       страница со своим адресом и заголовком (/portfolio/logistika/),
       и кнопки отраслей — обычные ссылки. Отфильтрованный скриптом вид
       поисковику не существовал: адрес оставался прежним. ---- */