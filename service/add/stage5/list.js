function fillCategory(){ 
 // this function is used to fill the category list on load
 
addOptGroup();
}

function SelectSubCat(){
// ON selection of category this function will work

removeAllOptions(document.drop_list.SubCat);

if(document.drop_list.Category.value == '1'){
addOption(document.drop_list.SubCat,"Γίνεται Benchmark με 3D Mark.", "Burn-In");
addOption(document.drop_list.SubCat,"Γίνεται εγκατάσταση λειτουργικού συστήματος.", "Setup");
}
if(document.drop_list.Category.value == '2'){
addOption(document.drop_list.SubCat,"Δεν βρέθηκε καμία βλάβη.", "No Problem");
addOption(document.drop_list.SubCat,"Επικοινώνησα με τον πελάτη για περισσοτερες πληροφοριές", "Details");
}
if(document.drop_list.Category.value == '3'){
addOption(document.drop_list.SubCat,"Έγινε BIOS upgrade.", "BIOS");
addOption(document.drop_list.SubCat,"Έγινε αντικατάσταση του", "Αντικατάσταση");
}
if(document.drop_list.Category.value == '4'){
addOption(document.drop_list.SubCat,"Να γίνει αντικατάσταση με άλλο ίδιο προϊον.", "Ίδιο");
addOption(document.drop_list.SubCat,"Να γίνει αντικατάσταση με παρεμφερες προϊον.", "Παρεμφερές");
}
if(document.drop_list.Category.value == '5'){
addOption(document.drop_list.SubCat,"Να επιστραφεί στον πελάτη έγινε έλεγχος όλα εντάξει.", "Έλεγχος");
addOption(document.drop_list.SubCat,"Να επιστραφεί στον πελάτη έγινε επισκευή όλα εντάξει.", "Επισκευή");
addOption(document.drop_list.SubCat,"Να επιστραφεί στον πελάτη χωρίς έλεγχο.", "Τίποτα");
}
if(document.drop_list.Category.value == '6'){
addOption(document.drop_list.SubCat,"Να γίνει πίστωση του προϊόντος", "Πίστωση");
}
if(document.drop_list.Category.value == '7'){
addOption(document.drop_list.SubCat,"Χρέωση για επισκευή του προϊόντος.", "Επισκευής");
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
