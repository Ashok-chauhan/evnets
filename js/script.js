function process(event) {
	const info = document.querySelector("#phone");
	const phoneNumber = phoneInput.getNumber();
	info.value = phoneNumber;
}
