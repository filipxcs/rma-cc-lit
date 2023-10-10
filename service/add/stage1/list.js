
function fillCategory(){ 
 // this function is used to fill the category list on load
addOption(document.drop_list.Category, "1", "PC", "");
addOption(document.drop_list.Category, "2", "Boards", "");
addOption(document.drop_list.Category, "3", "LAN/WAN", "");
addOption(document.drop_list.Category, "4", "Storage", "");
addOption(document.drop_list.Category, "5", "Printers", "");
addOption(document.drop_list.Category, "6", "MEM/CPU", "");
addOption(document.drop_list.Category, "7", "Accesories", "");
}

function SelectSubCat(){
// ON selection of category this function will work

removeAllOptions(document.drop_list.SubCat);

if(document.drop_list.Category.value == '1'){
addOption(document.drop_list.SubCat,"Το σύστημα δεν δίνει σήμα στην οθόνη.", "Δεν ανάβει");
addOption(document.drop_list.SubCat,"Το σύστημα δεν παίρνει τροφοδοσία.", "No Power");
addOption(document.drop_list.SubCat,"Κάνει Επανεκκινήσεις.", "Restart");
addOption(document.drop_list.SubCat,"Δεν γινεται εγκατάσταση του λειτουργικού.", "No Setup");
addOption(document.drop_list.SubCat,"Το σύστημα παγώνει.", "κολάει");
addOption(document.drop_list.SubCat,"Το σύστημα δεν εχει ήχο.", "No Sound");
}
if(document.drop_list.Category.value == '2'){
addOption(document.drop_list.SubCat,"Η μητρική δεν δίνει σήμα στην οθόνη.", "Δεν ανάβει");
addOption(document.drop_list.SubCat,"Η μητρική δεν πέρνει τροφοδοσία.", "No Power");
addOption(document.drop_list.SubCat,"Κάνει Επανεκκινήσεις.", "Restart");
addOption(document.drop_list.SubCat,"Δεν γινεται εγκατάσταση του λειτουργικού.", "No Setup");
addOption(document.drop_list.SubCat,"Το σύστημα παγώνει.", "κολλάει");
addOption(document.drop_list.SubCat,"Το σύστημα δεν εχει ήχο.", "No Sound");
}
if(document.drop_list.Category.value == '3'){
addOption(document.drop_list.SubCat,"Δεν κάνει (Link) με το υπόλοιπο δίκτυο.", "No Link");
addOption(document.drop_list.SubCat,"Δεν παίρνει τροφοδοσία.", "No Power");
addOption(document.drop_list.SubCat,"Μια ή περισσότερες πόρτες του δικτυου δεν λειτουργούν.", "LAN Off");
addOption(document.drop_list.SubCat,"Δεν μπορεί να γίνει εγκατάσταση μέσω WEB ή κονσόλας.", "No Setup");
}
if(document.drop_list.Category.value == '4'){
addOption(document.drop_list.SubCat,"Ο δισκος είναι χτυπημένος.", "HDD OFF");
addOption(document.drop_list.SubCat,"Ο δισκος κάνει θόρυβο.", "Sound");
addOption(document.drop_list.SubCat,"Ο δίσκος δεν αναγνωρίζεται απο το BIOS.", "No detect");
addOption(document.drop_list.SubCat,"Δεν παίρνει τροφοδοσία.", "No Power");
}
if(document.drop_list.Category.value == '5'){
addOption(document.drop_list.SubCat,"Δεν παίρνει τροφοδοσία.", "No Power");
addOption(document.drop_list.SubCat,"Δεν εκτυπώνει.", "No print");
addOption(document.drop_list.SubCat,"Έχει χτυπήσει η κεφαλή.", "Head Off");
addOption(document.drop_list.SubCat,"Μασάει το χαρτί στην εκτύπωση.", "Paper Jam");
addOption(document.drop_list.SubCat,"Αναβοσβήνουν τα led του εκτυπωτή.", "Blink");
}
if(document.drop_list.Category.value == '6'){
addOption(document.drop_list.SubCat,"Δεν δίνει σήμα στην οθόνη.", "Δεν ανάβει");
addOption(document.drop_list.SubCat,"Μπλε οθόνες σφάλματος στα Windows.", "Blue screen");
addOption(document.drop_list.SubCat,"Το λειτουργικό παγώνει.", "κολλάει");
addOption(document.drop_list.SubCat,"Κάνει Επανεκκινήσεις.", "Restart");
}

if(document.drop_list.Category.value == '7'){
addOption(document.drop_list.SubCat,"Δεν παίρνει τροφοδοσία.", "No Power");
addOption(document.drop_list.SubCat,"Δεν γινεται εγκατάσταση των οδηγών.", "No Setup");
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


function addOption(selectbox, value, text )
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;

	selectbox.options.add(optn);
}
