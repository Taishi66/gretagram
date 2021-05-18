<h1>Liste des Profils</h1>
<div class="listeProfils">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>nom</th>
                <th>prenom</th>
            </tr>
        </thead>

        <tbody id="listeProfils"></tbody>

    </table>
</div>

<script>
    $.getJSON("api.php?page=profils", function(data) {
        console.log(data);
        var num = 0;

        $.each(data, function(key, val) {
            num++;
            $("#listeProfils").append("<tr><td>" + num + "</td><td>" + val.nom + "</td><td>" + val.prenom + "</td></tr>");
        });
    });
</script>