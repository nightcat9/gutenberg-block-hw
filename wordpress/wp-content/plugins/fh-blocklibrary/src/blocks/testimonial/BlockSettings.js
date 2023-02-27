import React from "react";
import {InspectorControls, PanelColorSettings} from "@wordpress/block-editor";
import {PanelBody, PanelRow, SelectControl, ColorPalette, ColorPicker} from "@wordpress/components";
import {select} from "@wordpress/data";
import BackgroundPicker from "../../components/BackgroundPicker";

export class BlockSettings extends React.Component {
	render(){
		let {attributes, setAttributes} = this.props;
		let settings = select('core/editor').getEditorSettings();

		return (
			<InspectorControls>
				<PanelBody title="Basic" initialOpen={true}>
					<PanelRow>
						<BackgroundPicker
							label="New Quote Background Color"
							color={attributes.backgroundColorClass}
							setColor={color => setAttributes({backgroundColorClass: color})}
						/>
					</PanelRow>
					<PanelRow>
						Border Color
					</PanelRow>
					<PanelRow>
						<ColorPalette
							colors={
								[
									...settings.colors,
									{name: 'black', color:'#000000'},
								]
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
						<ColorPicker
							color={attributes.textColor}
							onChangeComplete={ colorObj => { setAttributes({textColor: colorObj.hex} ) } }
							disableAlpha
						/>
					</PanelRow>
				</PanelBody>
				<PanelColorSettings
					title="Color Settings"
					initialOpen={false}
					colorSettings={ [
						{
							value: attributes.backgroundColor,
							onChange: (color) => {setAttributes({backgroundColor: color})},
							label: 'Background Color',
						},
						{
							value: attributes.textColor,
							onChange: (color) => {setAttributes({textColor: color})},
							label: 'Text Color',
							colors: [
								...settings.colors,
								{name: 'White', slug: 'white', color: '#FFFFFF'},
							]
						},
					]}
				/>
			</InspectorControls>
		)
	}
}
