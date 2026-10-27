const btnTheme = document.getElementById("btnTheme");
const tema = localStorage.getItem("tema") || "terang";

document.documentElement.setAttribute("data-theme", tema);
if (btnTheme) btnTheme.textContent = tema === "gelap" ? "☀️" : "🌙";

if (btnTheme) {
  btnTheme.addEventListener("click", () => {
    const temaSekarang = document.documentElement.getAttribute("data-theme");
    const temaBaru = temaSekarang === "gelap" ? "terang" : "gelap";
    document.documentElement.setAttribute("data-theme", temaBaru);
    localStorage.setItem("tema", temaBaru);
    btnTheme.textContent = temaBaru === "gelap" ? "☀️" : "🌙";
  });
}
