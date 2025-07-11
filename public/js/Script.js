const navbar = document.getElementById('navbar');

		window.addEventListener('scroll', () => {
			if (window.scrollY > 50) { // Adjust this value based on when you want the color to change
				navbar.classList.add('scrolled');
			} else {
				navbar.classList.remove('scrolled');
			}
		});

		function ToggleSwitch() {
			var element = document.body;
			element.dataset.bsTheme =
				element.dataset.bsTheme == "light" ? "dark" : "light";
		}