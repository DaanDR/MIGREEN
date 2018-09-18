function addField() {
	document.getElementById("poep").innerHTML = "<select name='customername' required>" +
                            "<optgroup label='Kies een klant'>" +
                                "<option selected hidden>Kies een klant</option>" +
                                "<?php foreach($customers as $customer):?>" +
                                    "<option value='<?=$customer['customerName']?>'><?=$customer['customerName']?></option>" +
                                "<?php endforeach;?>" +
                            "</optgroup>" +
                        "</select>" +
						"<div class='buttons-right'>" +
                            "<button onclick='addField()' type='button' name='add' id='add' class='btn btn-info'><img src='../res/add.svg'></button>" +
                        "</div>";

}