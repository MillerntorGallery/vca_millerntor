lib.dropdown.kuenstler = COA
lib.dropdown.kuenstler {
	wrap = <div class="artist_select hidden-sm hidden-xs"><form action="GET"><select class="form-control" onchange="window.location=this.options[this.selectedIndex].value"><option value="">--Supporters--</option>|</select></form></div>
	10 = CONTENT
	10 {
		table = tx_vcamillerntor_domain_model_kuenstler
	  select {
	  	pidInList = 4
	    where = deleted=0 AND hidden=0 
	    orderBy = name
	  }
	  renderObj = COA
	  renderObj {
	  
	  	htmlSpecialChars = 1
	  	  
	    1 = TEXT
	    1 {
	    	typolink.parameter = 
	    	wrap = <option value="{getIndpEnv:TYPO3_SITE_URL}|">
	    	insertData = 1
          typolink {
          	useCacheHash = 1
          	parameter = 7
            additionalParams.cObject = COA
            additionalParams.cObject  {
			        
			        10 = TEXT
			        10.field = uid
			        10.wrap = &tx_vcamillerntor_kuenstler[kuenstler]=|
			        
			        15 = TEXT
			        15.value = &tx_vcamillerntor_kuenstler[action]=show

			        #20 = TEXT
			        #20.value = &tx_vcamillerntor_kuenstler[controller]=Kuenstler
            }
            returnLast = url
          }
	    }
	    
	    5 = TEXT
	    5 {	
	    	field = name
	    	wrap = |</option>
	    }	
	  }
	}

}
