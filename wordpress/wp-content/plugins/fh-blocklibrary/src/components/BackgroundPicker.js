import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {SelectControl} from "@wordpress/components";

class BackgroundPicker extends Component {
	render() {
		return (
			<div>
				<SelectControl
					label={this.props.label}
					value={this.props.color}
					onChange={ color => this.props.setColor(color) }
					options={ [
						{value: '', label: 'Default'},
						{value: 'bg-isabelline', label: 'Isabelline'},
						{value: 'bg-dun', label: 'Dun'},
					]}
				/>
			</div>
		);
	}
}

BackgroundPicker.propTypes = {
	"label": PropTypes.string,
	"color": PropTypes.string.isRequired,
	"setColor": PropTypes.func.isRequired,
};

export default BackgroundPicker;
