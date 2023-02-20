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
	return (
		<div { ...useBlockProps.save() }>
			<RichText.Content
				tagName="div"
				className="title"
				value={attributes.title}
			/>
			<div className="event-profile">
				<div className="event-photo">
					<img src={attributes.imgUrl} alt={"Photo of ______"} />
				</div>
				<div className="text">
					<p className="eventdetails">{attributes.eventdetails}</p>
					<p className="eventlocation">{attributes.eventlocation}</p>
				</div>

			</div>
		</div>
	);
}
