// scroll nav 200px

let navScroll = document.getElementsByClassName("navbar")[0];
window.onscroll = function () {
    if (document.documentElement.scrollTop > 100) {
        navScroll.style.backgroundColor = "brown";
    } else {
        navScroll.style.backgroundColor = "transparent";
    }
};


document.getElementById("donationForm")
    .addEventListener("submit", function (e) {
        e.preventDefault();

        let name = document.getElementById("name").value;
        let amount = document.getElementById("amount").value;

        document.getElementById("msg").innerHTML =
            "شكراً يا " + name + " ❤️ تم تسجيل تبرعك بقيمة " + amount + " جنيه";

        this.reset();
    });
