/**
 * AIPilot Demo - Editor registration for all custom blocks.
 *
 * Three block types:
 *  1) Container blocks - use InnerBlocks (hero, stats-grid, logo-strip,
 *     process-list, property-carousel, testimonial-slider).
 *  2) Child blocks - simple attribute render (stat-item, logo-item,
 *     process-step, testimonial-card).
 *  3) Dynamic blocks - rendered via ServerSideRender (property-card,
 *     process-media, consultation-badge, lead-form).
 */
( function( wp ) {
	var registerBlockType = wp.blocks.registerBlockType;
	var el                = wp.element.createElement;
	var ServerSideRender  = wp.serverSideRender;
	var useBlockProps     = wp.blockEditor.useBlockProps;
	var InnerBlocks       = wp.blockEditor.InnerBlocks;
	var __                = wp.i18n.__;
	var Placeholder       = wp.components.Placeholder;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody         = wp.components.PanelBody;
	var ToggleControl     = wp.components.ToggleControl;
	var TextControl       = wp.components.TextControl;

	// 1. CONTAINER BLOCKS (with InnerBlocks)

	// NOTE: 'aipilot-demo-blocks/hero' migrated to the aipilot-demo-blocks plugin
	// (src/hero/, built with @wordpress/scripts). Do not register it here — it would
	// cause a "Block is already registered" error in the editor.

	registerBlockType( 'aipilot-demo-blocks/stats-grid', {
		edit: function() {
			var blockProps = useBlockProps( { className: 'aipilot-stats-grid' } );
			return el( 'div', blockProps,
				el( InnerBlocks, {
					allowedBlocks: [ 'aipilot-demo-blocks/stat-item' ],
					renderAppender: InnerBlocks.ButtonBlockAppender
				} )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/logo-strip', {
		edit: function() {
			var blockProps = useBlockProps( { className: 'aipilot-logo-strip' } );
			return el( 'div', blockProps,
				el( InnerBlocks, {
					allowedBlocks: [ 'aipilot-demo-blocks/logo-item' ],
					orientation: 'horizontal',
					renderAppender: InnerBlocks.ButtonBlockAppender
				} )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/process-list', {
		edit: function( props ) {
			var a = props.attributes;
			var set = props.setAttributes;
			var blockProps = useBlockProps( { className: 'aipilot-process-list' } );
			return el( 'div', blockProps,
				el( InspectorControls, null,
					el( PanelBody, { title: __( 'Process Settings', 'aipilot-demo' ), initialOpen: true },
						el( ToggleControl, {
							label: __( 'Show dividers', 'aipilot-demo' ),
							checked: !! a.showDividers,
							onChange: function( v ) { set( { showDividers: v } ); }
						} ),
						el( ToggleControl, {
							label: __( 'Show numbers', 'aipilot-demo' ),
							checked: !! a.showNumbers,
							onChange: function( v ) { set( { showNumbers: v } ); }
						} ),
						el( TextControl, {
							label: __( 'Gap (px)', 'aipilot-demo' ),
							value: a.gap,
							onChange: function( v ) { set( { gap: v } ); }
						} )
					)
				),
				el( InnerBlocks, {
					allowedBlocks: [ 'aipilot-demo-blocks/process-step' ],
					renderAppender: InnerBlocks.ButtonBlockAppender
				} )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/property-carousel', {
		edit: function( props ) {
			var blockProps = useBlockProps( { className: 'aipilot-carousel' } );
			var isManual = ( props.attributes.sourceMode === 'manual' );
			if ( ! isManual ) {
				return el( 'div', blockProps,
					el( ServerSideRender, {
						block: 'aipilot-demo-blocks/property-carousel',
						attributes: props.attributes
					} )
				);
			}
			return el( 'div', blockProps,
				el( InnerBlocks, {
					allowedBlocks: [ 'aipilot-demo-blocks/property-card' ],
					renderAppender: InnerBlocks.ButtonBlockAppender
				} )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/testimonial-slider', {
		edit: function( props ) {
			var a = props.attributes;
			var set = props.setAttributes;
			var blockProps = useBlockProps( { className: 'aipilot-testimonial-slider' } );
			return el( 'div', blockProps,
				el( InspectorControls, null,
					el( PanelBody, { title: __( 'Slider Settings', 'aipilot-demo' ), initialOpen: true },
						el( ToggleControl, {
							label: __( 'Show arrows', 'aipilot-demo' ),
							checked: !! a.showArrows,
							onChange: function( v ) { set( { showArrows: v } ); }
						} ),
						el( ToggleControl, {
							label: __( 'Show dots', 'aipilot-demo' ),
							checked: !! a.showDots,
							onChange: function( v ) { set( { showDots: v } ); }
						} ),
						el( ToggleControl, {
							label: __( 'Autoplay', 'aipilot-demo' ),
							checked: !! a.autoplay,
							onChange: function( v ) { set( { autoplay: v } ); }
						} ),
						el( ToggleControl, {
							label: __( 'Loop', 'aipilot-demo' ),
							checked: !! a.loop,
							onChange: function( v ) { set( { loop: v } ); }
						} ),
						el( TextControl, {
							type: 'number',
							label: __( 'Cards per view', 'aipilot-demo' ),
							value: a.cardsPerView,
							onChange: function( v ) { set( { cardsPerView: parseInt( v, 10 ) || 1 } ); }
						} )
					)
				),
				el( InnerBlocks, {
					allowedBlocks: [ 'aipilot-demo-blocks/testimonial-card' ],
					orientation: 'horizontal',
					renderAppender: InnerBlocks.ButtonBlockAppender
				} )
			);
		},
		save: function() { return null; }
	} );

	// 2. CHILD BLOCKS (simple attribute render)

	registerBlockType( 'aipilot-demo-blocks/stat-item', {
		edit: function( props ) {
			var a = props.attributes;
			var blockProps = useBlockProps( { className: 'aipilot-stat-item' } );
			return el( 'div', blockProps,
				el( 'div', { className: 'aipilot-stat-item__value', style: { textAlign: 'center', fontWeight: '700', fontSize: '2rem' } },
					a.prefix ? el( 'span', null, a.prefix ) : null,
					el( 'span', null, a.value || '' ),
					a.suffix ? el( 'span', null, a.suffix ) : null
				),
				a.label ? el( 'p', { style: { textAlign: 'center', color: '#6F7377' } }, a.label ) : null
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/logo-item', {
		edit: function( props ) {
			var a = props.attributes;
			var blockProps = useBlockProps( { className: 'aipilot-logo-item' } );
			if ( a.logoImageUrl ) {
				return el( 'div', blockProps,
					el( 'img', {
						src: a.logoImageUrl,
						alt: a.alt || a.companyName || '',
						style: { maxHeight: '48px', width: 'auto', filter: a.monochrome ? 'grayscale(100%) opacity(0.7)' : 'none' }
					} )
				);
			}
			return el( 'div', blockProps,
				el( 'span', { style: { fontSize: '0.875rem', color: '#6F7377' } }, a.companyName || __( 'Logo', 'aipilot-demo' ) )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/process-step', {
		edit: function( props ) {
			var a = props.attributes;
			var blockProps = useBlockProps( { className: 'aipilot-process-step' } );
			return el( 'div', blockProps,
				el( 'div', { className: 'aipilot-process-step__icon', style: { flexShrink: 0, width: '44px', height: '44px', borderRadius: '50%', background: '#252525', color: '#fff', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 700 } }, a.stepNumber ),
				el( 'div', { style: { flex: 1 } },
					el( 'h4', { style: { margin: '0 0 0.25rem', fontSize: '1rem', fontWeight: 600 } }, a.title || '' ),
					a.description ? el( 'p', { style: { margin: 0, fontSize: '0.875rem', color: '#6F7377' } }, a.description ) : null
				)
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/testimonial-card', {
		edit: function( props ) {
			var a = props.attributes;
			var blockProps = useBlockProps( { className: 'aipilot-testimonial-card' } );
			return el( 'div', blockProps,
				el( 'blockquote', { style: { margin: '0 0 1rem', fontStyle: 'italic' } }, a.quote || '' ),
				el( 'div', { style: { display: 'flex', alignItems: 'center', gap: '0.5rem' } },
					a.avatarUrl
						? el( 'img', { src: a.avatarUrl, alt: a.authorName, style: { width: '40px', height: '40px', borderRadius: '50%' } } )
						: el( 'div', { style: { width: '40px', height: '40px', borderRadius: '50%', background: '#D4E4ED', display: 'flex', alignItems: 'center', justifyContent: 'center', fontWeight: 600 } }, ( a.authorName || '?' ).charAt( 0 ) ),
					el( 'div', null,
						el( 'cite', { style: { fontStyle: 'normal', fontWeight: 600 } }, a.authorName || '' ),
						a.authorRole ? el( 'div', { style: { fontSize: '0.75rem', color: '#6F7377' } }, a.authorRole ) : null
					)
				)
			);
		},
		save: function() { return null; }
	} );

	// 3. DYNAMIC BLOCKS (ServerSideRender)

	registerBlockType( 'aipilot-demo-blocks/property-card', {
		edit: function( props ) {
			var blockProps = useBlockProps();
			return el( 'div', blockProps,
				el( ServerSideRender, {
					block: 'aipilot-demo-blocks/property-card',
					attributes: props.attributes
				} )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/process-media', {
		edit: function( props ) {
			var blockProps = useBlockProps();
			return el( 'div', blockProps,
				el( ServerSideRender, {
					block: 'aipilot-demo-blocks/process-media',
					attributes: props.attributes
				} )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/consultation-badge', {
		edit: function( props ) {
			var blockProps = useBlockProps();
			return el( 'div', blockProps,
				el( ServerSideRender, {
					block: 'aipilot-demo-blocks/consultation-badge',
					attributes: props.attributes
				} )
			);
		},
		save: function() { return null; }
	} );

	registerBlockType( 'aipilot-demo-blocks/lead-form', {
		edit: function( props ) {
			var a = props.attributes;
			var set = props.setAttributes;
			var blockProps = useBlockProps();
			return el( 'div', blockProps,
				el( InspectorControls, null,
					el( PanelBody, { title: __( 'Form Settings', 'aipilot-demo' ), initialOpen: true },
						el( TextControl, {
							label: __( 'Submit button text', 'aipilot-demo' ),
							value: a.submitText,
							onChange: function( v ) { set( { submitText: v } ); }
						} ),
						el( TextControl, {
							label: __( 'Success message', 'aipilot-demo' ),
							value: a.successMessage,
							onChange: function( v ) { set( { successMessage: v } ); }
						} ),
						el( TextControl, {
							type: 'email',
							label: __( 'Recipient email (override)', 'aipilot-demo' ),
							value: a.recipientEmail,
							help: __( 'Leave empty to use default from settings.', 'aipilot-demo' ),
							onChange: function( v ) { set( { recipientEmail: v } ); }
						} ),
						el( TextControl, {
							type: 'url',
							label: __( 'Redirect URL after submit', 'aipilot-demo' ),
							value: a.redirectUrl,
							onChange: function( v ) { set( { redirectUrl: v } ); }
						} )
					),
					el( PanelBody, { title: __( 'Fields', 'aipilot-demo' ), initialOpen: true },
						el( ToggleControl, {
							label: __( 'Show phone', 'aipilot-demo' ),
							checked: !! a.showPhone,
							onChange: function( v ) { set( { showPhone: v } ); }
						} ),
						a.showPhone ? el( ToggleControl, {
							label: __( 'Phone required', 'aipilot-demo' ),
							checked: !! a.phoneRequired,
							onChange: function( v ) { set( { phoneRequired: v } ); }
						} ) : null,
						el( ToggleControl, {
							label: __( 'Show email', 'aipilot-demo' ),
							checked: !! a.showEmail,
							onChange: function( v ) { set( { showEmail: v } ); }
						} ),
						el( ToggleControl, {
							label: __( 'Show message', 'aipilot-demo' ),
							checked: !! a.showMessage,
							onChange: function( v ) { set( { showMessage: v } ); }
						} )
					)
				),
				el( ServerSideRender, {
					block: 'aipilot-demo-blocks/lead-form',
					attributes: props.attributes
				} )
			);
		},
		save: function() { return null; }
	} );

} )( window.wp );