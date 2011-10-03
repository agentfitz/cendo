$(document).ready(function () {

if ($.browser.msie && $.browser.version < 7) return; // Don't execute code if it's IE6 or below cause it doesn't support it.

  $(".fade").fadeTo(1, 1);
  $(".fade").hover(
    function () {
      $(this).fadeTo("fast", 0.43);
    },
    function () {
      $(this).fadeTo("slow", 1);
    }
  );
});
