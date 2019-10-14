
$(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="sku[]" id="sku" placeholder="SKU" style="margin-right: 3px; margin-top: 2px;"/><input type="text" name="size[]" id="size" placeholder="Size" style="margin-right: 3px; margin-top: 2px;"/><input type="text" name="price[]" id="price" placeholder="Price" style="margin-right: 3px; margin-top: 2px;"/><input type="text" name="stock[]" id="stock" placeholder="Stock" style="margin-right: 3px; margin-top: 2px;"/><a href="javascript:void(0);" class="remove_button">Remove</div>'; //New input field html
        var x = 1; //Initial field counter is 1
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });

});
