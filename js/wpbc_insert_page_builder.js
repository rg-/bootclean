(function ($) {
  // initalise the dialog
  var page_builder_dialog = '#page-builder-dialog';
  $(page_builder_dialog).dialog({
    title: 'Page Builder Plus',
    dialogClass: 'wp-dialog',
    autoOpen: false,
    draggable: false,
    width: 'auto',
    modal: true,
    resizable: false,
    closeOnEscape: true,
    position: {
      my: "center",
      at: "center",
      of: window
    },
    open: function () { 
      // close dialog by clicking the overlay behind it
      $('.ui-widget-overlay').bind('click', function(){
        $(page_builder_dialog).dialog('close');
      })
    },
    create: function () {
      // style fix for WordPress admin
      $('.ui-dialog-titlebar-close').addClass('ui-button');
    },
  }); 
  // bind a button or a link to open the dialog  
  var link = '#menu-pages a[href="edit.php?post_type=page&page=wpbc-edit-new-page-builder-plus"]'; 

  $(link).on('click',function(e){
    e.preventDefault();
    $(page_builder_dialog).dialog('open');
  }); 

})(jQuery);