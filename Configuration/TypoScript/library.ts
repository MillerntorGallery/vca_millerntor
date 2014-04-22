lib.dropdown.kuenstler = COA
lib.dropdown.kuenstler {
	wrap = <div class="artist_select"><select class="form-control">|</select></div>
	10 = CONTENT
	10 {
		table = tx_vcamillerntor_domain_model_kuenstler
	  select {
	  	pidInList = 4
	    where = deleted=0 AND hidden=0 
	  }
	  renderObj = COA
	  renderObj {
	    
	    1 = TEXT
	    1 {
	    	typolink.parameter = 
	    }
	    
	    5 = TEXT
	    5 {	
	    	field = name
	    	wrap = <option>|</option>
	    }	
	  }
	}

}
