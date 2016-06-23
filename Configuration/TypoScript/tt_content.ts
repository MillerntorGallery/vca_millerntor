lib.foo = USER
lib.foo {
    userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
    extensionName = VcaMillerntor
    pluginName = Werke
    vendorName = VCA
    action = insertRecord
}
lib.foo = TEXT
lib.foo.value = xxx



tt_content.shortcut.20.0.tables := addToList(tx_vcamillerntor_domain_model_werk)
tt_content.shortcut.20.1.tables := addToList(tx_vcamillerntor_domain_model_werk)

/*

tx_yourtable = COA
tx_yourtable {
10 = TEXT
10.field = uid
10.wrap = Uid:|<br />
20 = TEXT
20.field = title
20.wrap = Title:|<br />
}

tt_content.shortcut.20.0.conf.tx_vcamillerntor_domain_model_werk < tx_yourtable
*/
#tt_content.shortcut.20.0.conf.tx_vcamillerntor_domain_model_werk = COA
tt_content.shortcut.20.0.conf.tx_vcamillerntor_domain_model_werk {
#    10 = USER
#    10 {
	    userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
	   	extensionName = VcaMillerntor
	    pluginName = Werke
	    vendorName = VCA
	    action = insertRecord
#    }
#    20 = CONTENT 
#    20 {
#        table = tx_vcamillerntor_domain_model_werk
#        select {
#         pidInList = 4
#        } 
#    }
   
   # userFunc = tx_extbase_core_bootstrap->run
   # pluginKey = vca_millerntor
   # pluginName = Werke
   # controller = Werk
   /*
    action = show
    switchableControllerActions {
        Werke {
            1 = show
        }
    }
    settings =< plugin.tx_vcamillerntor.settings
		persistence =< plugin.tx_vcamillerntor.persistence
		view =< plugin.tx_vcamillerntor.view
	*/
10 = TEXT
10.value = xxxxxx
/*
20 = CONTENT 
    20 {
        table = tx_vcamillerntor_domain_model_werk
        select {
         pidInList = 4
        } 
    }
*/
#10.field = uid
#10.wrap = Uid:|xxx<br />
}

tt_content.shortcut.20.0.conf.tx_vcamillerntor_domain_model_werk <.lib.foo

tt_content.shortcut.20.1.conf.tx_vcamillerntor_domain_model_werk = COA
tt_content.shortcut.20.1.conf.tx_vcamillerntor_domain_model_werk {
	10 = TEXT
	10.value = cccc
}

tt_content.shortcut.20.0.conf.tx_vcamillerntor_domain_model_kuenstler <.lib.foo

/*
tx_vcamillerntor_domain_model_werk >
tx_vcamillerntor_domain_model_werk =< plugin.tx_vcamillerntor

tt_content.shortcut.20.0.conf.tx_vcamillerntor_domain_model_werk =< tt_content.list.20.vcamillerntor_werke
*/