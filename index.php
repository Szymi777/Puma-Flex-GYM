<?php include 'header.php'; ?>

<main>
    <div class="hero">
        <div class="hero-content">
            <h2>ZBUDUJ <span>NAJSILNIEJSZĄ</span> WERSJĘ SIEBIE</h2>
            <p>Ekskluzywna siłownia premium dla ludzi, którzy nie uznają kompromisów. Dołącz do elity i przekraczaj swoje granice.</p>
            <a href="oferta.php" class="btn">DOŁĄCZ TERAZ</a>
        </div>
    </div>

    <section id="dlaczego-my">
        <h2 class="section-title">Dlaczego <span>Puma Flex</span>?</h2>
        <div class="grid-container">
            <div class="card">
                <h3>Sprzęt klasy światowej</h3>
                <p>Najnowsze maszyny Technogym i Hammer Strength. Bez kolejek, bez kompromisów.</p>
            </div>
            <div class="card">
                <h3>Trenerzy elity</h3>
                <p>Mistrzowie Polski, certyfikowani eksperci. Profesjonalne przygotowanie do zawodów sylwetkowych i trójbojowych.</p>
            </div>
            <div class="card">
                <h3>Strefa VIP & Opieka</h3>
                <p>Prywatne treningi, darmowe izotoniki, a na start -50% zniżki na stałą opiekę lekarską i fizjoterapeutyczną.</p>
            </div>
        </div>
    </section>

    <section id="kontakt">
        <h2 class="section-title">Skontaktuj się <span>z nami</span></h2>
        <div class="form-container">
            <form action="kontakt_handler.php" method="POST">
                <div class="form-group">
                    <label for="name">Imię i nazwisko</label>
                    <input type="text" id="name" name="name" required placeholder="Wpisz swoje imię i nazwisko">
                </div>
                <div class="form-group">
                    <label for="email">Adres E-mail</label>
                    <input type="email" id="email" name="email" required placeholder="Wpisz adres e-mail">
                </div>
                <div class="form-group">
                    <label for="message">Wiadomość</label>
                    <textarea id="message" name="message" rows="5" required placeholder="W czym możemy pomóc?"></textarea>
                </div>
                <button type="submit" class="btn">WYŚLIJ WIADOMOŚĆ</button>
            </form>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>