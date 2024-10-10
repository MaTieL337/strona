let repairCount = 1;

function addRepairSection() {
    repairCount++;
    const repairSection = document.createElement('div');
    repairSection.className = 'repair-section';
    repairSection.innerHTML = `
        <div class="form-row">
            <div class repair-container>
                <label for="nazwa-naprawy-${repairCount}">Nazwa naprawy:</label>
                <input type="text" id="nazwa-naprawy-${repairCount}" name="nazwa-naprawy[]" >
            </div>
            <div class="price-container">
                <label for="cena-${repairCount}">Cena:</label>
                <input type="number" id="cena-${repairCount}" name="cena[]" >
            </div>
            <button type="button" class="remove-repair-btn" onclick="removeRepairSection(this)"><b>X</b></button>
        </div>
    `;
    document.getElementById('repair-sections').appendChild(repairSection);
}

function removeRepairSection(button) {
    const section = button.closest('.repair-section');
    section.remove();
}