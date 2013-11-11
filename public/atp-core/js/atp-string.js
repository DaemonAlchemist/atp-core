String.prototype.truncate = function(maxLength, suffix) {
	return this.length > maxLength + suffix.length
		? this.substr(0, maxLength) + suffix
		: this;
}
