/* Панель управления: мелкие удобства.

   Правило то же, что на сайте: ни одного обработчика в разметке и ни одной
   строки кода в HTML. Политика безопасности панели задана как script-src 'self'
   без unsafe-inline, то есть встроенный скрипт просто не выполнится — и это
   страховка от подстановки кода через любое поле ввода.

   Без этого файла панель полностью работоспособна: здесь только счётчики
   знаков, подтверждение удаления и сворачивание длинных списков. */

(function () {
  "use strict";

  /* ---- Счётчик знаков у полей с ограничением длины.
         Нужен для заголовков в поиске: Google обрезает title примерно
         на 580 пикселях, что ближе всего к 60 знакам. ---- */
  var counted = document.querySelectorAll("[data-max]");
  Array.prototype.forEach.call(counted, function (el) {
    var max = parseInt(el.getAttribute("data-max"), 10);
    if (!max) return;

    var out = document.createElement("div");
    out.className = "counter";
    el.parentNode.insertBefore(out, el.nextSibling);

    function show() {
      var n = el.value.length;
      out.textContent = n + " из " + max;
      if (n > max) {
        out.className = "counter over";
        out.textContent = n + " из " + max + " — длиннее нужного";
      } else {
        out.className = "counter";
      }
    }
    el.addEventListener("input", show);
    show();
  });

  /* ---- Подтверждение необратимого действия. Текст берём из атрибута:
         «Удалить?» без указания, что именно, — бесполезный вопрос. ---- */
  document.addEventListener("submit", function (ev) {
    var f = ev.target;
    if (!f || !f.getAttribute) return;
    var ask = f.getAttribute("data-confirm");
    if (ask && !window.confirm(ask)) ev.preventDefault();
  });

  /* ---- Поиск по строкам словаря: их больше трёхсот, и прокручивать
         список глазами бессмысленно. Фильтр по ключу и по тексту. ---- */
  var box = document.getElementById("texts-filter");
  if (box) {
    var rows = [].slice.call(document.querySelectorAll("[data-text-row]"));
    var live = document.getElementById("texts-count");

    var filter = function () {
      var q = box.value.trim().toLowerCase();
      var n = 0;
      rows.forEach(function (r) {
        var on = q === "" || (r.getAttribute("data-text-row") || "").indexOf(q) !== -1;
        r.hidden = !on;
        if (on) n++;
      });
      if (live) live.textContent = q === ""
        ? "Показаны все " + rows.length
        : "Найдено " + n + " из " + rows.length;
    };
    box.addEventListener("input", filter);
    filter();
  }

  /* ---- Предупреждение о несохранённом. Человек правит текст, уходит
         в другой раздел и теряет работу — обиднее этого в редакторе мало что
         есть. Следим за любым изменением в форме с data-guard. ---- */
  var guarded = document.querySelectorAll("form[data-guard]");
  Array.prototype.forEach.call(guarded, function (f) {
    var dirty = false;
    f.addEventListener("input", function () { dirty = true; });
    f.addEventListener("change", function () { dirty = true; });
    f.addEventListener("submit", function () { dirty = false; });
    window.addEventListener("beforeunload", function (ev) {
      if (!dirty) return;
      ev.preventDefault();
      ev.returnValue = "";
    });
  });
})();
