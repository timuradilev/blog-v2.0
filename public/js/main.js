var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};
function escapeHtml (string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}
$(function() {
    //show search input form in navbar
  $("#search-button").click(function() {
    $("#search-form").removeClass("search-form").addClass("search-form_expanded");
    $("#full_header-navbar-items > .nav-item").addClass("d-none");
  });
  //remove search input form from navbar
  $("#search-button-close").click(function(event) {
    event.preventDefault();
    $("#search-form").removeClass("search-form_expanded").addClass("search-form");
    $("#full_header-navbar-items > .nav-item").removeClass("d-none");
  });
});