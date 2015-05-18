/* Configuration */
var _wrs_conf_editorEnabled = true;
var _wrs_conf_CASEnabled = true;

var _wrs_conf_imageMathmlAttribute = 'alt';	// Specifies the image tag where we should save the formula editor mathml code. In this integration, we use _wrs_temporalImage to comunicate mathml to the formula editor window.
var _wrs_conf_CASMathmlAttribute = 'alt';	// Specifies the image tag where we should save the WIRIS CAS mathml code. In this integration, we use _wrs_temporalImage to comunicate the mathml to the formula editor window.

var _wrs_conf_editorPath = _wrs_currentPath + '/pluginwiris/integration/editor.php';	// Editor window.
var _wrs_conf_editorAttributes = 'width=500, height=400, scroll=no, resizable=yes';		// Editor window attributes
var _wrs_conf_CASPath = _wrs_currentPath + '/pluginwiris/integration/cas.php';			// CAS window.
var _wrs_conf_CASAttributes = 'width=640, height=480, scroll=no, resizable=yes';		// CAS window attributes.

var _wrs_conf_createimagePath = _wrs_currentPath + '/pluginwiris/integration/createimage.php';			// Script to create images.
var _wrs_conf_createcasimagePath = _wrs_currentPath + '/pluginwiris/integration/createcasimage.php';	// Script to create CAS images.
var _wrs_conf_getmathmlPath = _wrs_currentPath + '/pluginwiris/integration/getmathml.php';				// Specifies where is getmathml script

var _wrs_conf_saveMode = 'tags';		// this value can be 'tags', 'xml' or 'safeXml'.

/* Vars */
// Vars name sintax are: _wrs_int_*. For example, this variable is true when editor window is opened (use it to prevent two editor windows opened at the same time):
var _wrs_int_window_opened = false;
var _wrs_int_editorIcon = _wrs_currentPath + '/pluginwiris/core/icons/formula.gif';
var _wrs_int_CASIcon = _wrs_currentPath + '/pluginwiris/core/icons/cas.gif';
var _wrs_int_language = 'en';

// Also, remember to set _wrs_isNewElement as true or false when you are opening a new editor or CAS window if you are creating a new formula/CAS or not. This is VERY IMPORTANT.
// Finally, we initialize _wrs_temporalImage. This variable is used by the formula editor. It gets the _wrs_conf_imageMathmlAttribute and puts it on the Java editor.
_wrs_temporalImage = document.createElement('img');

/* Functions */
// Functions name sintax are: wrs_int_*.

/**
 * This function must be called at program start, and it should:
 *	- Assign events to the main iframe with wrs_addIframeEvents function. Sintax: wrs_addIframeEvents(iframe, wrs_int_doubleClickHandler, wrs_int_mousedownHandler, wrs_int_mouseupHandler).
 *	- Add the editor toolbar button.
 */
function wrs_int_init(/* Your own params */) {
	// At first, we get the textarea. For example:
	var textarea = $('#editorContainer');/* Your own way to get the textarea */
	alert(textarea);
	// Then, we assign events to the textarea. For example:
	wrs_addTextareaEvents(textarea, wrs_int_clickHandler);
	
	// Finally, we must add toolbar buttons to the editor. Implement your own code.
	// You can use _wrs_int_editorIcon and _wrs_int_CASIcon variables.
	// For example:
	if (_wrs_conf_editorEnabled) {
		/* Add the editor button to the toolbar using _wrs_int_editorIcon */
	}
	
	if (_wrs_conf_CASEnabled) {
		/* Add the CAS button to the toolbar using _wrs_int_CASIcon */
	}
}

/**
 * Handles a click on the textarea
 * You can use this function to edit existing formulas. You must integrate this feature as you want.
 * @param object textarea Target
 * @param object event Event triggered
 */
function wrs_int_clickHandler(textarea, event) {
	/* Your own code */
}

/**
 * Calls wrs_updateFormula with well params.
 * This function is called when you click on "Ok" button in editor window.
 * This function must call wrs_updateFormula with iframe param and mathml param.
 * In this demo version, we will add the link to the image in the textarea.
 * @param string mathml
 */
function wrs_int_updateFormula(mathml) {
	var text = window.location.protocol + '//' + window.location.host + wrs_createImageSrc(mathml);		// Our PHP returns a absolute path to our image, but without the protocol, the host and the location. We are completing the link.
	wrs_updateTextarea($('#editorContainer'), text);		// We add the link to the textarea
}

/**
 * Calls wrs_updateCAS with well params.
 * This function is called when you click on "Ok" button in CAS window.
 * This function must call wrs_updateCAS with iframe param and mathml param.
 * In this demo, we will add the link to the previsualization image in the textarea.
 * @param string appletCode
 * @param string image
 * @param int width
 * @param int height
 */
function wrs_int_updateCAS(appletCode, image, width, height) {
	var text = window.location.protocol + '//' + window.location.host + wrs_createImageCASSrc(image, appletCode);		// We use appletCode in wes_createImageCASSrc because this appletCode will be stored on formulas/ server directory with image md5 as file name. Then, we can open this file with PHP and create a filter that replaces this link with its code.
	wrs_updateTextarea(_wrs_int_temporalTextarea, text);
}

/**
 * Handles window closing.
 * This function is called when you closes editor or CAS window.
 */
function wrs_int_notifyWindowClosed() {
	_wrs_int_window_opened = false;
}
