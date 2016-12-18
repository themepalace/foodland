( function( api ) {

	// Extends our custom "foodland" section.
	api.sectionConstructor['foodland'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
