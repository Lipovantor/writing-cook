// Page Speed JQuery optimization
jQuery.event.special.touchstart = {
  setup: function( _, ns, handle ) {
    this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
  }
};
jQuery.event.special.touchmove = {
  setup: function( _, ns, handle ) {
    this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
  }
};

jQuery(document).ready(function ($) {
  
})