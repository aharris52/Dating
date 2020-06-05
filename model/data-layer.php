<?php

//getter for gender
function getGender()
{
    $gender = array("Male", "Female");
    return $gender;
}

//retrieve indoor activities fxn
function getInDoor()
{
    $indoor = array("Make nachos", "Watch \"Cops\"", "Play drums",
                    "Make bunk beds", "River boat gambling", "Make beef jerky",
                    "Read \"Good Housekeeping\"", "Practice Karate in the garage");
    return $indoor;
}

//retrieve outdoor activities fxn
function getOutDoor()
{
    $outdoor = array("Nunchucks", "Research & Development", "Smoke with Johnny Hopkins",
                    "Crossbows", "Black leather gloves", "Put liquid paper on a bee",
                    "Nachos and Lemonheads on my Dad's boat...",
                    "Catalina Wine Mixer");
    return $outdoor;
}

//retrieve applicant state
function getState()
{
    $states = array(" ",
                    "Alabama",
                    "Alaska",
                    "Arizona",
                    "Arkansas",
                    "California",
                    "Colorado",
                    "Connecticut",
                    "Delaware",
                    "Florida",
                    "Georgia",
                    "Hawaii",
                    "Idaho",
                    "Illinois",
                    "Indiana",
                    "Iowa",
                    "Kansas",
                    "Kentucky",
                    "Louisiana",
                    "Maine",
                    "Maryland",
                    "Massachusetts",
                    "Michigan",
                    "Minnesota",
                    "Mississippi",
                    "Missouri",
                    "Montana",
                    "Nebraska",
                    "Nevada",
                    "New Hampshire",
                    "New Jersey",
                    "New Mexico",
                    "New York",
                    "North Carolina",
                    "North Dakota",
                    "Ohio",
                    "Oklahoma",
                    "Oregon",
                    "Pennsylvania",
                    "Rhode Island",
                    "South Carolina",
                    "South Dakota",
                    "Tennessee",
                    "Texas",
                    "Utah",
                    "Vermont",
                    "Virginia",
                    "Washington",
                    "West Virginia",
                    "Wisconsin",
                    "Wyoming"
    );
    return $states;
}
