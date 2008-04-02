

var StarRating = {
    gif: ['/images/ratings/stars-0-0.gif',
          '/images/ratings/stars-1-0.gif',
          '/images/ratings/stars-2-0.gif',
          '/images/ratings/stars-3-0.gif',
          '/images/ratings/stars-4-0.gif',
          '/images/ratings/stars-5-0.gif',
          ], 
    
    current: '/images/ratings/stars-0-0.gif',
    
    show:function(star_rating) {
        var stars_el = $("stars");
        if (star_rating == "1starRating") {
            stars_el.src = StarRating.gif[1];
        }
        else if (star_rating == "2starRating") {
            stars_el.src = StarRating.gif[2];
        }
        else if (star_rating == "3starRating") {
            stars_el.src = StarRating.gif[3];
        }
        else if (star_rating == "4starRating") {
            stars_el.src = StarRating.gif[4];
        }
        else if (star_rating == "5starRating") {
            stars_el.src = StarRating.gif[5];
        }
    },

    restore:function() {
        var stars_el = $("stars");
        stars_el.src = StarRating.current;
    },

    select:function(star_rating) {
        if (star_rating == "1starRating") {
            StarRating.current = StarRating.gif[1];
        }
        else if (star_rating == "2starRating") {
            StarRating.current = StarRating.gif[2];
        }
        else if (star_rating == "3starRating") {
            StarRating.current = StarRating.gif[3];
        }
        else if (star_rating == "4starRating") {
            StarRating.current = StarRating.gif[4];
        }
        else if (star_rating == "5starRating") {
            StarRating.current = StarRating.gif[5];
        }
    },
    
    initTooltip:function() {
        star1RatingTooltip = new YAHOO.widget.Tooltip("star1RatingTooltip", { 
            context:"1starRating", 
            text:"Poor",
            showDelay:200 } );
    
        star2RatingTooltip = new YAHOO.widget.Tooltip("star2RatingTooltip", { 
            context:"2starRating", 
            text:"Not good",
            showDelay:200 } );
    
        star3RatingTooltip = new YAHOO.widget.Tooltip("star3RatingTooltip", { 
            context:"3starRating", 
            text:"Ok",
            showDelay:200 } );
    
        star4RatingTooltip = new YAHOO.widget.Tooltip("star4RatingTooltip", { 
            context:"4starRating", 
            text:"I like it",
            showDelay:200 } );
    
        star5RatingTooltip = new YAHOO.widget.Tooltip("star5RatingTooltip", { 
            context:"5starRating", 
            text:"Awesome!",
           showDelay:200 } );
    
    }
}
