import {createHigherOrderComponent} from '@wordpress/compose';
import {Fragment} from '@wordpress/element';
import {InspectorControls} from "@wordpress/block-editor";
import {PanelBody, PanelRow, SelectControl, RangeControl, ColorPalette } from "@wordpress/components";
import {addFilter} from '@wordpress/hooks';
import {select} from "@wordpress/data";
import React from "react";

// create a wrapper function which will receive the block we are trying to wrap
function blockWrapper(WrappedBlock) {
	// return a React component
	return class extends React.Component {
		render() {
			let settings = select('core/editor').getEditorSettings();
			let {attributes, setAttributes} = this.props;

			let divStyles = {
				borderStyle: attributes.borderStyle || 'none',
				borderWidth: attributes.borderWidth || '2px',
				borderColor: attributes.borderColor || 'black',
				borderRadius: attributes.borderRadius || '0px',
			}

			return (
				<Fragment>
					{/* This is panel/toolbar we are adding to each block */}
					<InspectorControls>
						<PanelBody title="Border Controls" initialOpen={false}>
							<PanelRow>
								<SelectControl
									label="Style"
									value={attributes.borderStyle}
									onChange={borderStyle => setAttributes({borderStyle})}
									options={[
										{label: 'None', value: 'none'},
										{label: 'Solid', value: 'solid'},
										{label: 'Dashed', value: 'dashed'},
										{label: 'Dotted', value: 'dotted'},
									]}
								/>
							</PanelRow>
							<PanelRow>
								<RangeControl
									label="Border Width"
									value={ attributes.borderWidth }
									onChange={borderWidth => setAttributes({borderWidth})}
									step={ 0.5 }
									min={ 0.5 }
									max={ 5 }
								/>
							</PanelRow>
							<PanelRow>
								<RangeControl
									label="Border Radius"
									value={ attributes.borderRadius }
									onChange={borderRadius => setAttributes({borderRadius})}
									step={ 1 }
									min={ 0 }
									max={ 10 }
								/>
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
						</PanelBody>
					</InspectorControls>

					{/* This is a wrapper -- WrappedBlock is the block you are editing/wrapping */}
					<div className="wp-block" style={divStyles}>
						<WrappedBlock {...this.props} />
					</div>
				</Fragment>
			)
		}
	}
}

// Higher Order Components is a pretty high-level concept, but here's a good explanation:
// https://reactjs.org/docs/higher-order-components.html
// Note: this is *similar* to what WordPress does, but WordPress does not provide good documentation for this.
const borderComponent = createHigherOrderComponent(blockWrapper, 'border-control');

// register our filter with WordPress
addFilter('editor.BlockEdit', 'fh-blocklibrary/border-control/border-wrapper', borderComponent);
