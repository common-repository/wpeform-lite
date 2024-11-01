/* globals tinymce */
(function () {
	if (
		typeof window.wpEFormTinyMceRegistrar === 'function' &&
		typeof tinymce !== 'undefined'
	) {
		// this window namespace comes from the universal admin enqueue
		window.wpEFormTinyMceRegistrar(tinymce);
	}
})();
