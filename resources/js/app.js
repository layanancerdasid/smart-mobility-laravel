import "./bootstrap";
import "./tutorial"

document.addEventListener("livewire:navigated", () => {
    lucide.createIcons();
});
