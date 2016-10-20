<?php

/**
 * Monk-ee HTML5 Inputs - Language
 */

$lang = array(
//Field Info
'monkhtml5_default_field_name' => "Monk-ee HTML5 Inputs",
'monkhtml5_default_field_desc' => "A fieldtype allowing for the output of the new HTML5 input types in Freeform.",
'monkhtml5_default_field_type' => "monkee_html5",

//Settings
'monkhtml5_field_content_type' => "Field Content Type",
'monkhtml5_field_content_type_desc' => "Select an HTML5 Input fieldtype from the list. <a href='http://www.w3schools.com/htmL/html_form_input_types.asp' target='_blank'>Click here for descriptions on each fieldtype.</a>",
'monkhtml5_field_length' => "Field Length",
'monkhtml5_field_length_desc' => "Maximum length of inputed data.",
'monkhtml5_disallow_html_rendering' => "Prevent User HTML Rendering",
'monkhtml5_disallow_html_rendering_desc' => "By default, HTML tags will be encoded so that they will not render on output. This prevents users from inputting HTML and showing images or their own custom output on your pages.",
'monkhtml5_enable_autofocus' => "Enable Autofocus",
'monkhtml5_placeholder' => "Placeholder",
'monkhtml5_placeholder_desc' => "The value in this field will be inserted into the field as temporary, placeholder text. Can be used as a way to label the field or provide instructions on the type of data or format expected. Only works on certain fieldtypes.",
'monkhtml5_default_value' => "Default Value",
'monkhtml5_default_value_desc' => "If form data is not being edited, this will be the default entry value in the field. NOTE: Setting the inline 'default_value' parameter will override these settings. Make sure value is correctly formatted for the fieldtype. May not work on all fieldtypes.",
'monkhtml5_min_max' => "Min/Max Values",
'monkhtml5_min_max_desc' => "<b>For Number and Range fields ONLY.</b> Enter minimum and maximum numbers for the Number and Range fields. Number fields will not allow any number not between these two numbers. Range fields will use these to set the range of numbers the slider can select.",
'monkhtml5_min' => "Min:",
'monkhtml5_max' => "Max:",
'monkhtml5_enable_autofocus_desc' => "Field will automatically be selected on page load. If multiple fields on a form have this property enabled, the field loaded first will claim control.",
'monkhtml5_enable' => "Enable",
'monkhtml5_field_title' => "Populate Title Parameter",
'monkhtml5_field_title_desc' => "Select if and how you want to populate the title field in the input tag. This is useful for displaying tooltips. NOTE: Setting the inline 'attr:title' parameter will override these settings.",
'monkhtml5_field_none' => "None",
'monkhtml5_field_label' => "Field Label",
'monkhtml5_field_desc' => "Field Description",
'monkhtml5_field_custom' => "Custom",
'monkhtml5_field_title_custom' => "Enter custom title here",
'monkhtml5_css_classes' => "CSS Classes",
'monkhtml5_css_classes_desc' => "Output as many classes as you like. The checkboxes will add dynamic information as classes. Enter any custom classes in the text box. NOTE: Setting the inline 'attr:class' parameter will override these settings. For Field Content Type, Color -> color, Date -> date, Date/Time -> datetime-local, Email -> email, Month -> month, Number -> number, Range -> range, Tel -> tel, Time -> time, URL -> url, Week -> week. Field Name pulls from the Field Name value shown above. Freeform Field Type will output 'monkee_html5'",
'monkhtml5_css_content' => "Field Content Type",
'monkhtml5_css_name' => "Field Name",
'monkhtml5_css_type' => "Freeform Field Type",
'monkhtml5_css_custom' => "Enter custom css styles here",
'monkhtml5_custom_params' => "Custom Parameters",
'monkhtml5_custom_params_desc' => "Enter custom parameters and values here. Values not required. These will be added to the field tag.",
'monkhtml5_custom_place' => "Parameter",
'monkhtml5_custom_value' => "Value",
'monkhtml5_js_event' => "Custom Javascript/jQuery Event",
'monkhtml5_js_event_desc' => "For advanced users only. Select a javascript event from the dropdown box. Then, in the textbox, enter the javascript (or jQuery) you would like to attach to this event. <b>PLEASE NOTE: Because of the way Freeform handles field entry on this page, you must escape parentheses with a backslash. Failing to do this will result in this form not saving. Also, DO NOT USE DOUBLE QUOTES, only single quotes. Ex: alert&#92;('test'&#92;);.</b> <a href='http://www.w3schools.com/jsref/dom_obj_event.asp' target='_blank'>Click here to view a list of javascript events and descriptions.</a> NOTE: Setting the inline 'attr:onclick' parameter will override an onclick action setup here.",
'monkhtml5_js_action' => "Enter JavaScript/jQuery action here",
'monkhtml5_js_confirm' => "I confirm that I am an advanced user and have read the instructions.",

//Content Types
'color' => "Color",
'date' => "Date",
'datetime-local' => "Date/Time",
'email' => "Email",
'month' => "Month",
'number' => "Number",
'range' => "Range",
'tel' => "Tel",
'time' => "Time",
'url' => "URL",
'week' => "Week",

//Errors
'max_length_exceeded' => "Maximum field length of %num% exceeded.",

//END
'' => ''
);
