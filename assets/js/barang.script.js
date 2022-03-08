const forms = document.getElementById("forms");
const keyword = document.getElementById("keyword");
const table = document.getElementById("tbody");
let fetching = async data => {
    return await fetch("fetch.php", {
        method: "POST",
        body: data
    }).then(resp => resp.json()).catch(resp => console.log(resp));
}

let render = ({
    data
}) => {
    let text = "";
    data.forEach((val, i) => {
        text += `
        <tr>
            <td>${i + 1}</td>
            <td>${val.kdbarang}</td>
            <td>${val.nmbarang}</td>
            <td>${val.stok}</td>
            <td>${val.harga}</td>
            <td>${val.tglkedaluarsa}</td>
            <td>${val.kdkategori}</td>
            <td>
                <img src="img/${val.picture}" alt="${val.picture}">
            </td>
            <td>
                <div class="aksi">
                    <a href="editbarang.php?id=${val.kdbarang}">
                        <button class="edit">
                            Edit
                        </button>
                    </a>
                    <a href="hapusbarang.php?id=${val.kdbarang}" onclick="return confirm('Hapus data barang ini?')">
                        <button class="delete">
                            Hapus    
                        </button>
                    </a>
                </div>
            </td>
        </tr>
        `
    })
    table.innerHTML = text;
}

keyword.addEventListener("keyup", async e => {
    let data = new FormData(forms);
    let fetchData = await fetching(data);
    console.log(fetchData)
    render(fetchData);
})