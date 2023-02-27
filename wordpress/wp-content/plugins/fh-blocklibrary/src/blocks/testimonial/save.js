/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save({attributes}) {
	let  starIcons = Array(5)
		.fill('&starf;', 0, attributes.stars)
		.join('');

	let divStyles = {
		borderColor: attributes.borderColor, backgroundColorClass: attributes.backgroundColorClass,
	}

	return (
		<div { ...useBlockProps.save({className: attributes.backgroundColorClass, style: divStyles})} >
			<div className="stars">{starIcons}</div>
			<RichText.Content
				tagName="div"
				className="quote"
				value={attributes.quote}
			/>
			<div className="quote-profile">
				<div className="photo">
					<img src={attributes.imgUrl} alt={"Photo of ________"} />
				</div>
				<div className="text">
					<p className="author">{attributes.author}</p>
					<p className="location">{attributes.location}</p>
				</div>
			</div>
		</div>
	);
}
