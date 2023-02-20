/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { MediaUpload, MediaUploadCheck, PlainText } from '@wordpress/block-editor';
import { DateTimePicker } from '@wordpress/components';
import { useState } from '@wordpress/element';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({attributes, setAttributes}) {
	const [ date, setDate ] = useState( new Date() );
	return (
		<div { ...useBlockProps() }>
			<RichText
				tagName="h2"
				value={ attributes.title }
				allowedFormats={ [ 'core/bold', 'core/italic' ] } // Allow the content to be made bold or italic, but do not allow othe formatting options
				onChange={ ( title ) => setAttributes( { title } ) }
				placeholder={ __( 'Heading...' ) }
			/>
			<div className="event-profile">
				<div className="event-photo">
					<MediaUploadCheck>
						<MediaUpload
							onSelect={(media) => setAttributes({imgUrl: media.sizes.medium.url})
							}
							allowedTypes={['image']}
							render={({open}) => (
								<img src={attributes.imgUrl} onClick={open}/>
							)}
						/>
					</MediaUploadCheck>
				</div>
				<div className="text">
					<PlainText
						placeholder="Event Details"
						value={attributes.eventdetails}
						onChange={eventdetails => setAttributes({eventdetails})}
						className="eventdetails"
					/>
					<PlainText
						placeholder="Waukesha"
						value={attributes.eventlocation}
						onChange={eventlocation => setAttributes({eventlocation})}
						className="locationdetails"
					/>
				</div>
				<DateTimePicker
					currentDate={ date }
					onChange={ ( newDate ) => setDate( newDate ) }
					is12Hour={ true }
					__nextRemoveHelpButton
					__nextRemoveResetButton
				/>
			</div>
		</div>
	);
}
