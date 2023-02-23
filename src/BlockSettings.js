import React from "react";
import {InspectorControls, PanelColorSettings} from "@wordpress/block-editor";
import {PanelBody, PanelRow, SelectControl, ColorPalette, ColorPicker} from "@wordpress/components";
import {select} from "@wordpress/data";

export class BlockSettings extends React.Component {
	render(){
		let {attributes, setAttributes} = this.props;
		let settings = select('core/editor').getEditorSettings();
		console.log('SETTINGS!', settings);

		return (
			<InspectorControls>
				<PanelBody title="Basic" initialOpen={true}>
					<PanelRow>
						<SelectControl
							label="Calendar Background Color"
							value={attributes.backgroundColorClass}
							onChange={ backgroundColorClass => { setAttributes( { backgroundColorClass } ) } }
							options={ [
								{value: '', label: 'Default'},
								{value: 'bg-teal', label: 'Teal'},
								{value: 'bg-dark-slate-gray', label: 'Dark Slate Gray'},
								{value: 'bg-misty-rose', label: 'Misty Rose'},
								{value: 'bg-midnight-blue', label: 'Midnight Blue'},
								{value: 'bg-white', label: 'White'}
							]}
						/>
					</PanelRow>
					<PanelRow>
						Border Color
					</PanelRow>
					<PanelRow>
						<ColorPalette
							colors={
								settings.colors
							}
							disableCustomColors={settings.disableCustomColors}
							value={attributes.borderColor}
							onChange={ borderColor => { setAttributes({borderColor} ) } }
							/>
					</PanelRow>
					<PanelRow>
						Text Color
					</PanelRow>
					<PanelRow>
						<ColorPalette
							colors={
								settings.colors
							}
							disableCustomColors={settings.disableCustomColors}
							value={attributes.textColor}
							onChange={ textColor => { setAttributes({textColor} ) } }
						/>
					</PanelRow>
				</PanelBody>

			</InspectorControls>
		)
	}
}
