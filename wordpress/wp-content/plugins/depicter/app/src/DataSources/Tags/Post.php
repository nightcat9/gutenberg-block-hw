<?php

namespace Depicter\DataSources\Tags;

/**
 * Asset Group for WP posts
 *
 * {{{module->slug}}}
 * {{{module->slug|func('a','b')}}}
 *
 */
class Post extends TagBase implements TagInterface {

	/**
	 *  Asset group ID
	 */
	const ASSET_GROUP_ID = 'post';

	/**
	 * Get label of asset group
	 *
	 * @return string
	 */
	public function getName(){
		return __( "General", 'depicter' );
	}

	/**
	 * Get list of assets in this group
	 *
	 * @param array  $args
	 *
	 * @return array
	 */
	public function getAssetBlocks( array $args = [] ){

		return [
			[
				'id'    => 'title',
				'title' => __( 'Title', 'depicter' ),
				'previewOptions' => [
					"size" => 100,
					'multiline' => true,
					'badge' => null
				],
				'type'  => 'dynamicText',
				'func'  => null,
				'payload' => [
					'tag' => 'post->title|cTrim(30)'
				]
			],
			[
				'id'    => 'content',
				'title' => __( 'Content', 'depicter' ),
				'previewOptions' => [
					"size" => 100,
					'multiline' => true,
					'badge' => null
				],
				'type'  => 'dynamicText',
				'func'  => null,
				'payload' => [
					'tag' => 'post->content|wTrim(50)'
				]
			],
			[
				'id'    => 'excerpt',
				'title' => __( 'Excerpt', 'depicter' ),
				'previewOptions' => [
					"size" => 100,
					'multiline' => true,
					'badge' => null
				],
				'type'  => 'dynamicText',
				'func'  => null,
				'payload' => [
					'tag' => 'post->excerpt|wTrim(50)'
				]
			],
			[
				'id'    => 'url',
				'title' => __( 'Post Link', 'depicter' ),
				'previewOptions' => [
					"size" => 50,
					'variant' => 'button',
					'badge' => null
				],
				'type'  => 'dynamicLink',
				'func'  => null,
				'payload' => [
					'tag' => 'post->url'
				]
			],
			[
				'id'    => 'featuredImage',
				'title' => __( 'Featured Image', 'depicter' ),
				'previewOptions' => [
					"size" => 50,
					'badge' => null
				],
				'type'  => 'dynamicMedia',
				'func'  => null,
				'sourceType' => 'image',
				'payload' => [
					'tag' => 'post->featuredImage|toImage'
				]
			],
			[
				'id'    => 'date',
				'title' => __( 'Date', 'depicter' ),
				'previewOptions' => [
					"size" => 50,
					'multiline' => false,
					'badge' => null
				],
				'type'  => 'date',
				'func'  => null,
				'payload' => [
					'tag' => 'post->date'
				]
			],
			[
				'id'    => 'author.name',
				'title' => __( 'Author Name', 'depicter' ),
				'previewOptions' => [
					"size" => 50,
					'multiline' => false,
					'badge' => null
				],
				'type'  => 'dynamicText',
				'func'  => null,
				'payload' => [
					'tag' => 'post->author.name'
				]
			],
			[
				'id'    => 'author.page',
				'title' => __( 'Author Page', 'depicter' ),
				'previewOptions' => [
					"size" => 50,
					'variant' => 'link',
					'badge' => null
				],
				'type'  => 'dynamicLink',
				'func'  => null,
				'payload' => [
					'tag' => 'post->author.page'
				]
			]
		];

	}

	/**
	 * Get value of tag by tag name (slug)
	 *
	 * @param string $tagName  Tag name
	 * @param array  $args     Arguments of current document section
	 *
	 * @return string
	 */
	public function getSlugValue( string $tagName = '', array $args = [] ){

		if( ! $post = get_post( $args['post'] ?? null ) ){
			return $tagName;
		}

		$result = $tagName;

		switch ( $tagName ) {
			case 'uuid':
			case 'id':
				$result = $post->ID;
				break;

			case 'url':
				$result = get_permalink( $post->ID );
				break;

			case 'title':
				$result = get_the_title( $post->ID );
				break;

			case 'featuredImage':
				$result = get_post_thumbnail_id( $post->ID );
				break;

			case 'date':
				$result = get_the_date('', $post->ID );
				break;

			case 'excerpt':
				$result = get_the_excerpt( $post->ID );
				break;

			case 'author.name':
				$result = get_the_author_meta( 'display_name', $post->post_author );
				break;

			case 'author.page':
				$result = get_author_posts_url( $post->post_author );
				break;

			case 'content':
				$result = get_the_content(null, false, $post->ID );
				break;

			default:
				$result = null;
				break;
		}

		return $result;
	}

	/**
	 * Converts attachment ID to attachment source
	 *
	 * @param mixed $value      The tag value to be piped
	 * @param array $funcArgs   Function args presented in dynamic tag
	 * @param array $args       Arguments of current document section
	 *
	 * @return mixed|string
	 */
	public function toSrc( $value, array $funcArgs = [], array $args = [] ){
		$imageSize = $funcArgs[0] ?? 'full';

		$attachmentImageInfo = wp_get_attachment_image_src( $value, $imageSize );
		return ! empty( $attachmentImageInfo[0] ) ? $attachmentImageInfo[0] : '';
	}


}
