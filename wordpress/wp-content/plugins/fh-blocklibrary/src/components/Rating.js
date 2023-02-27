import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {SelectControl} from "@wordpress/components";

class Rating extends Component {
	render() {
		return (
			<div>
				<SelectControl
					label={this.props.label}
					value={this.props.rating}
					onChange={ rating => this.props.setRating(parseInt(rating)) }
					options={ [
						{value: 1, label: '&starf;'},
						{value: 2, label: '&starf;&starf;'},
						{value: 3, label: '&starf;&starf;&starf;'},
						{value: 4, label: '&starf;&starf;&starf;&starf;'},
						{value: 5, label: '&starf;&starf;&starf;&starf;&starf;'}
					]}
				/>
			</div>
		);
	}
}

Rating.propTypes = {
	"label": PropTypes.string.isRequired,
	"rating": PropTypes.number.isRequired,
	"setRating": PropTypes.func.isRequired,
};

export default Rating;
