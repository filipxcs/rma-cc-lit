function fillCategory(){ 
 // this function is used to fill the category list on load
 
addOptGroup();
}

function SelectSubCat(){
// ON selection of category this function will work

removeAllOptions(document.drop_list.SubCat);

if(document.drop_list.Category.value == '1'){
addOption(document.drop_list.SubCat,"3D Mark Benchmark", "Burn-In");
addOption(document.drop_list.SubCat,"Ελεγχος με εγκατάσταση λειτουργικού συστήματος", "Setup");
}
if(document.drop_list.Category.value == '2'){
addOption(document.drop_list.SubCat,"Ενημερώθηκε ο πελάτης ότι δεν βρέθηκε καμία βλάβη.", "No Problem");
addOption(document.drop_list.SubCat,"Επικοινώνησα με τον πελάτη για περισσότερες πληροφοριές", "Details");
}
if(document.drop_list.Category.value == '3'){
addOption(document.drop_list.SubCat,"Έγινε BIOS upgrade.", "BIOS");
addOption(document.drop_list.SubCat,"Έγινε αντικατάσταση του", "Αντικατάσταση");
}
if(document.drop_list.Category.value == '4'){
addOption(document.drop_list.SubCat,"Να γίνει αντικατάσταση με ίδιο προϊον.", "Ίδιο");
addOption(document.drop_list.SubCat,"Να γίνει αντικατάσταση με παρεμφερές προϊον.", "Παρεμφερές");
}
if(document.drop_list.Category.value == '5'){
addOption(document.drop_list.SubCat,"Να επιστραφεί στον πελάτη, έγινε έλεγχος, όλα εντάξει.", "Έλεγχος");
addOption(document.drop_list.SubCat,"Να επιστραφεί στον πελάτη, έγινε επισκευή, όλα εντάξει.", "Επισκευή");
addOption(document.drop_list.SubCat,"Να επιστραφεί στον πελάτη χωρίς έλεγχο.", "Τίποτα");
}
if(document.drop_list.Category.value == '6'){
addOption(document.drop_list.SubCat,"Να γίνει πίστωση του προϊόντος", "Πίστωση");
}
if(document.drop_list.Category.value == '7'){
addOption(document.drop_list.SubCat,"Ο δίσκος που παραλάβαμε προς επισκευή έχει περάσει τα Χ έτη της εγγύησης του και θα επιστραφεί στην WD για αντικατάσταση. Σημειώστε ότι ο συνήθης χρόνος αντικατάστασης είναι 4 εβδομάδες. Σε περίπτωση που επιθυμείτε άμεση αντικατάσταση με νέο δίσκο και ανανέωση της εγγύησης υπάρχει επιβάρυνση ΧΧ€. Επιθυμείτε την αντικατάσταση με νέο δίσκο με την αντίστοιχη χρέωση;", "Διαφορά τιμής");
addOption(document.drop_list.SubCat,"Αγαπητέ συνεργάτη,Ο δίσκος που παραλάβαμε προς επισκευή έχει περάσει τα Χ χρόνια της εγγύησης του.Έχουμε τη δυνατότητα να τον επιστρέψουμε στην WD και να αντικατασταθεί με έναν επισκευασμένο, με χρόνο αντικατάστασης 4 εβδομάδων ή να πιστώσουμε στην καρτέλα σας το αντίστοιχο ποσό.Επιθυμείτε να πιστώσουμε στην καρτέλα σας το αντίστοιχο ποσό;", "Πίστωση");
addOption(document.drop_list.SubCat,"Χρέωση για επισκευή προϊόντος λόγω βλάβης από υπαιτιότητα.", "Υπαιτιότητα");
addOption(document.drop_list.SubCat,"Χρέωση για επισκευή προϊόντος εκτός εγγύησης.", "Εκτός Εγγύησης");
}
if(document.drop_list.Category.value == '9'){
addOption(document.drop_list.SubCat,"Χρέωση δίσκου.", "Αντικατάσταση");
}


}
////////////////// 

function removeAllOptions(selectbox)
{
	var i;
	for(i=selectbox.options.length-1;i>=0;i--)
	{
		//selectbox.options.remove(i);
		selectbox.remove(i);
	}
}


function addOption(selectbox, value, text)
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;

	selectbox.options.add(optn);
}

function addOptGroup()
   {
    var select = document.getElementById( "Category" );
    
    var optgroup = document.createElement( "optgroup" );
    optgroup.label = "Κινήσεις";
    select.appendChild( optgroup );

    var option = new Option();
    option.value = "1";
    option.appendChild( document.createTextNode( "Έλεγχος" ));

    optgroup.appendChild( option );

    var option = new Option();
    option.value = "2";
    option.appendChild( document.createTextNode( "Επικοινωνία" ));

    optgroup.appendChild( option );

    var option = new Option();
    option.value = "3";
    option.appendChild( document.createTextNode( "Επισκευή" ));

    optgroup.appendChild( option );
	
	var option = new Option();
    option.value = "7";
    option.appendChild( document.createTextNode( "Χρέωση" ));

    optgroup.appendChild( option );
	
	var option = new Option();
    option.value = "9";
    option.appendChild( document.createTextNode( "Επιλογή χειρισμού" ));

    optgroup.appendChild( option );
	
	var option = new Option();
    option.value = "8";
    option.appendChild( document.createTextNode( "Εσωτερικό/Κρυφό" ));

    optgroup.appendChild( option );
	
		
	var optgroup = document.createElement( "optgroup" );
    optgroup.label = "Τερματισμός";
    select.appendChild( optgroup );
	
	var option = new Option();
    option.value = "4";
    option.appendChild( document.createTextNode( "Αντικατάσταση" ));

    optgroup.appendChild( option );

    var option = new Option();
    option.value = "5";
    option.appendChild( document.createTextNode( "Επιστροφή" ));

    optgroup.appendChild( option );
	
    var option = new Option();
    option.value = "6";
    option.appendChild( document.createTextNode( "Πίστωση" ));

    optgroup.appendChild( option );

    return false;    
   }
