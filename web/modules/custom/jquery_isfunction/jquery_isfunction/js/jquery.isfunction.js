(function( $ ){
   //$.isFunction = function(item) {
   //   return (typeof item === 'function');
   //};
   $.fn.isFunction = function(fn) {
      return (typeof fn === 'function');
   };
   $.isFunction = function( obj ) {
      return (typeof obj === 'function');
  };
})( jQuery );