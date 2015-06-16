$.Isotope.prototype._getCenteredMasonryColumns = function() {

    this.width = this.element.width();

    var parentWidth = this.element.parent().width();

    var colW = this.options.masonry && this.options.masonry.columnWidth || // i.e. options.masonry && options.masonry.columnWidth

    this.$filteredAtoms.outerWidth(true) || // or use the size of the first item

    parentWidth; // if there's no items, use size of container

    var cols = Math.floor(parentWidth / colW);

    cols = Math.max(cols, 1);

    this.masonry.cols = cols; // i.e. this.masonry.cols = ....
    this.masonry.columnWidth = colW; // i.e. this.masonry.columnWidth = ...
};

$.Isotope.prototype._masonryReset = function() {

    this.masonry = {}; // layout-specific props
    this._getCenteredMasonryColumns(); // FIXME shouldn't have to call this again

    var i = this.masonry.cols;

    this.masonry.colYs = [];
        while (i--) {
        this.masonry.colYs.push(0);
    }
};

$.Isotope.prototype._masonryResizeChanged = function() {

    var prevColCount = this.masonry.cols;

    this._getCenteredMasonryColumns(); // get updated colCount
    return (this.masonry.cols !== prevColCount);
};

$.Isotope.prototype._masonryGetContainerSize = function() {

    var unusedCols = 0,

    i = this.masonry.cols;
        while (--i) { // count unused columns
        if (this.masonry.colYs[i] !== 0) {
            break;
        }
        unusedCols++;
    }

    return {
        height: Math.max.apply(Math, this.masonry.colYs),
        width: (this.masonry.cols - unusedCols) * this.masonry.columnWidth // fit container to columns that have been used;
    };
};
jQuery(document).ready(function() {
 
  var $container = jQuery('#container');
  var iso_page = $container.is('ul');
  if($container ) {
    
    
  
  var $container = jQuery('#container'),
          // object that will keep track of options
          isotopeOptions = {},
          // defaults, used if not explicitly set in hash
          defaultOptions = {
            filter: '*',
            sortBy: 'original-order',
            sortAscending: true,
            layoutMode: 'masonry'
          };

      // ensure no transforms used in Opera
     /*
      if ( jQuery.browser.opera ) {
        defaultOptions.transformsEnabled = false;
      }
    */
    var setupOptions = jQuery.extend( {}, defaultOptions, {
        itemSelector : '.item',
        masonry : {
          
          gutterWidth: 15
        },
        masonryHorizontal : {
          rowHeight: 350,
          gutterHeight: 15
        },
        
        cellsByColumn : {
          columnWidth : 330,
  
        }, 
        getSortData : {
          category : function( $elem ) {
            return $elem.attr('data-category');
          },
          number : function( $elem ) {
            return parseInt( $elem.find('.number').text(), 10 );
          },
          name : function ( $elem ) {
            return $elem.find('.normName').text();
          },
      alphabetical: function( $elem ) {
      var name = $elem.find('.normName'),
        itemText = name.length ? name : $elem;
      return itemText.text();
      }
        },
        sortBy: 'name',
      });
    
    // bind filter button click
    $('#filter').on( 'click', 'button', function() {
      var filterValue = $( this ).attr('data-filter');
      $('#filter button').removeClass('active');
      $( this ).addClass('active');
      //console.log('filter:'+filterValue);
      // use filterFn if matches value
      //filterValue = filterFns[ filterValue ] || filterValue;
      $container.isotope({ filter: filterValue });
    });
  
      //first load images than go on...
    $container.imagesLoaded(function() {
        //find text pics
        $('.item .csc-textpic').each(function(index,element) {
          var $element = $(element);
          
          /*
          $element.addClass('flip_container vert');
          $element.find('.csc-textpic-imagewrap').addClass('flip_card shadow');
          $element.find('.csc-textpic-firstcol').addClass('front face');
          $element.find('.csc-textpic-lastcol').addClass('back face');
          */
          $element.addClass('flip_container vert');
          $element.find('.csc-textpic-imagewrap').addClass('flip_card shadow');
          $element.find('.csc-textpic-firstcol').addClass('front face');
          $element.find('.csc-textpic-lastcol').addClass('back face');
          

        });
        //this timer is just a bugfix on safari
        setTimeout(function() {
          
        //find flip_container in container
      
      $('.flip_container').each(function(index, element) {
        var $element = $(element);
        var height = $element.find('.front img').height();
        var width = $element.find('.front img').width();
        $element.css('height',height);
        $element.css('width',width);
        $element.find('.back .well').css('height',height);
        $element.find('.back .well').css('width',width);
      });

      // set up Isotope 
      $container.isotope( setupOptions );
        }, 1000);

      
    });
      


    
    var $optionSets = jQuery('#options').find('.option-set'),
          isOptionLinkClicked = false;
  
      // switches selected class on buttons
      function changeSelectedLink( $elem ) {
        // remove selected class on previous item
        $elem.parents('.option-set').find('.selected').removeClass('selected');
        // set selected class on new item
        $elem.addClass('selected');
      }
  
  
  
  
  
      $optionSets.find('a').click(function(){
        var $this = jQuery(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return;
        }
        changeSelectedLink( $this );
            // get href attr, remove leading #
        var href = $this.attr('href').replace( /^#/, '' );
            // convert href into object
            // i.e. 'filter=.inner-transition' -> { filter: '.inner-transition' }
           var option = jQuery.deparam( href, true );
       //debug.log( 'option', option );
       if(option.layoutMode) {
       $container.toggleClass('straightDown').isotope('reLayout');
       }
        // apply new option to previous
        jQuery.extend( isotopeOptions, option );
    // set hash, triggers hashchange on window
        jQuery.bbq.pushState( isotopeOptions );
        isOptionLinkClicked = true;
        if(iso_page) {
      return false;
    } else {
      //go to startpage
      document.location.href= '/' + $this.attr('href');
      return true;
    }
      });
      
      
      
      
      
/*
      var hashChanged = false;

      jQuery(window).bind( 'hashchange', function( event ){
        // get options object from hash
        var hashOptions = window.location.hash ? jQuery.deparam.fragment( window.location.hash, true ) : {},
            // do not animate first call
            aniEngine = hashChanged ? ( jQuery.browser.opera ? 'jquery' : 'best-available' ) : 'none',
            // apply defaults where no option was specified
            options = jQuery.extend( {}, defaultOptions, hashOptions, { animationEngine: aniEngine } );
      //alert(hashOptions);
      //debug.log( 'coerced', hashOptions );
      jQuery("#container a").fragment( hashOptions );
        // apply options from hash
        $container.isotope( options );
        // save options
        isotopeOptions = hashOptions;
    
        // if option link was not clicked
        // then we'll need to update selected links
        if ( !isOptionLinkClicked ) {
          // iterate over options
          var hrefObj, hrefValue, $selectedLink;
          for ( var key in options ) {
            hrefObj = {};
            hrefObj[ key ] = options[ key ];
            // convert object into parameter string
            // i.e. { filter: '.inner-transition' } -> 'filter=.inner-transition'
            hrefValue = jQuery.param( hrefObj );
            // get matching link
            $selectedLink = $optionSets.find('a[href="#' + hrefValue + '"]');
            changeSelectedLink( $selectedLink );
      if(key === 'layoutMode' && options[ key ] === 'straightDown') {
        $container.addClass('straightDown').isotope('reLayout');
      } 
        
          }
        }
    
        isOptionLinkClicked = false;
        hashChanged = true;
      })
        // trigger hashchange to capture any hash data on init
        .trigger('hashchange');

*/    
    
  
    
      
  /*
  jQuery('#nav-panel').portamento({
    
    gap: 80
  });
  */
  } else {
  
  //jQuery('#nav-panel').hide();
  }
});
