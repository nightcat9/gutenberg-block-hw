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
import { useBlockProps } from '@wordpress/block-editor';
import { RichText } from '@wordpress/block-editor';
import { SelectControl } from '@wordpress/components';
import { MediaUpload, MediaUploadCheck, PlainText } from '@wordpress/block-editor';
import {BlockSettings} from "./BlockSettings";


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import Rating from "../../components/Rating";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({attributes, setAttributes}) {

	let divStyles = {
		borderColor: attributes.borderColor,
		color: attributes.textColor,
	}

	return (
		<div { ...useBlockProps({className: attributes.backgroundColorClass, style: divStyles})}>
			<BlockSettings attributes={attributes} setAttributes={setAttributes} />
			<Rating
				label="Rating"
				rating={attributes.stars}
				setRating={stars => setAttributes({stars})}
			/>
			<RichText
				tagName="div"
				value={ attributes.quote }
				allowedFormats={ [ 'core/bold', 'core/italic' ] } // Allow the content to be made bold or italic, but do not allow othe formatting options
				onChange={ ( quote ) => setAttributes( { quote } ) }
				placeholder={ __( 'Lorem ipsum...' ) }
			/>
			<div className="quote-profile">
				<div class="photo">
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ ( media ) => setAttributes({imgUrl: media.sizes.thumbnail.url})
							}
							allowedTypes={ ['image'] }
							render={ ( { open } ) => (
								<img src={attributes.imgUrl} onClick={ open } />
							) }
						/>
					</MediaUploadCheck>
				</div>
				<div className="text">
					<PlainText
						placeholder="Eric Foreman"
						value={attributes.author}
						onChange={author => setAttributes({author})}
						className="author"
					/>
					<PlainText
						placeholder="Waukesha"
						value={attributes.location}
						onChange={location => setAttributes({location})}
						className="location"
					/>
				</div>
			</div>

		</div>
	);
}
