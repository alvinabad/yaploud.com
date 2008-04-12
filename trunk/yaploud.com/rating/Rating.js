/**
 * Rating Modulei
 * 
 * Created on Mar 9, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

var Votes = {
    current: 0,
    
    render:function() {
        var votes_el = $("votes");
        var votes_txt = Votes.current + " votes";
        
        if (Votes.current == 1) {
            votes_txt = Votes.current + " vote";
        }
            
        votes_el.innerHTML = votes_txt;
    },
    
    set:function(votes) {
    	Votes.current = votes;
    	Votes.render();
    }
};

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

    render:function() {
        var stars_el = $("stars");
        stars_el.src = StarRating.current;
    },
    
    render2:function(rating) {
    	var img_el = this;
    	alert(rating);
    },   
    
    init:function() {
        StarRating.render();	
        StarRating.initTooltip();	
    },
    
    set:function(rating) {
    	var star_rating;
    	
        if (rating<0 || rating >5) {
        	return;
        }
        
        StarRating.current = StarRating.getImage(rating);
        StarRating.render();
    },
    
    getImage:function(rating) {
        var img;
        
        if (rating<0 || rating >5) {
            return;
        }
        
        if (rating > 4.75) {
            img = '/images/ratings/stars-5-0.gif';
        }
        else if (rating > 4.25) {
            img = '/images/ratings/stars-4-5.gif';
        }
        else if (rating > 3.75) {
            img = '/images/ratings/stars-4-0.gif';
        }
        else if (rating > 3.25) {
            img = '/images/ratings/stars-3-5.gif';
        }
        else if (rating > 2.75) {
            img = '/images/ratings/stars-3-0.gif';
        }
        else if (rating > 2.25) {
            img = '/images/ratings/stars-2-5.gif';
        }
        else if (rating > 1.75) {
            img = '/images/ratings/stars-2-0.gif';
        }
        else if (rating > 1.25) {
            img = '/images/ratings/stars-1-5.gif';
        }
        else if (rating > 0.75) {
            img = '/images/ratings/stars-1-0.gif';
        }
        else if (rating > 0.25) {
            img = '/images/ratings/stars-0-5.gif';
        }
        else {
            img = '/images/ratings/stars-0-0.gif';
        }
        
        return img;
    },
    
    select:function(star_rating) {
    	if (StarRating.has_rated) {
    		alert("You've already rated.");
    		return;
    	}
    	
    	var rating = 0;
    	
        if (star_rating == "1starRating") {
            rating = 1;
        }
        else if (star_rating == "2starRating") {
            rating = 2;
        }
        else if (star_rating == "3starRating") {
            rating = 3;
        }
        else if (star_rating == "4starRating") {
            rating = 4;
        }
        else if (star_rating == "5starRating") {
            rating = 5;
        }
        
        if (rating !=0 ) {
            update_current_rating = false;
            SendRating.sendRequest(rating);
            StarRating.set(rating);
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

var url_SendRating = "/rating/updateRating.php";

var SendRating = {
    has_rated: false,
    
    handleFailure:function(o){
        //alert('Sending logout failed: ' + o.responseText + ': ' + o.status);
        alert('Server failure. Please try again later. ' + o.status);
    },

    handleSuccess:function(o){
        var guestname = eval('(' + o.responseText + ')');
        GetMessages.sendRequest();
        StarRating.has_rated = true;
        //alert("Thank you for rating!");
    },

    sendRequest:function(rating) {
    	if (username.substr(0,5) == "guest") {
    		//alert("Requires login to rate: " + rating);
    		//return;
    	}
    	
        var url = encodeURIComponent(site_url);
        url = url_SendRating + "?url=" + url + "&rating=" + rating;
        YAHOO.util.Connect.asyncRequest('GET', url, SendRating_callback, null);
    }

};

var SendRating_callback = {
    success: SendRating.handleSuccess,
    failure: SendRating.handleFailure,
    scope: SendRating,
    timeout: 4500,
    cache: false
};
