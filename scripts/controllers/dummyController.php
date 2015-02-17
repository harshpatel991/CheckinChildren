<?php
//Files located in the controller folder recieve form data input when a user submits a form

//An example of a controllers that creates new employees:

//Read in POST data

// model = new userModel(POST['name'], POST['address'], POST['phone_number'], POST['facility_id'])
// isValid = model.isValid();

// if (isValid)
    //call the userDAO and insert the new user
    //redirect to the employee home page with a success message
// else
    //redirect to employee creation page with error message