import {addFilter} from '@wordpress/hooks';

function addBorderProps(saveElementProps, blockType, attributes) {

	// only add if they picked a border style
	if (attributes.borderStyle) {
		saveElementProps.style = saveElementProps.style || {};
		saveElementProps.style.borderStyle = attributes.borderStyle;
		if(attributes.borderWidth){
			saveElementProps.style.borderWidth = attributes.borderWidth + 'px'
		}
		if(attributes.borderRadius){
			saveElementProps.style.borderRadius = attributes.borderRadius + 'px'
		}
		if(attributes.borderColor){
			saveElementProps.style.borderColor = attributes.borderColor
		}
		//saveElementProps.style.borderWidth = '2px';
	}

	return saveElementProps;
}

addFilter('blocks.getSaveContent.extraProps', 'fh-blocklibrary/border-control/add-border-props', addBorderProps);

