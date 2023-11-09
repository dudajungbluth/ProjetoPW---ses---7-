function pag() {
    window.location.href = "index.html";
  }
  function user() {
    window.location.href = "usuario.html";
  }
  function roupas() {
    window.location.href = "roupas.html";
  }
  function perfil() {
    window.location.href = "perfil.html";
  }

const form = document.querySelector('.formphoto');
const btn = document.querySelector('#change-photo-btn');



    form.addEventListener('submit', async (e) => {

        e.preventDefault();
        
        const data = await fetch('upload.php', {
        method: 'POST',
        body: new FormData(form)
        }).then(res => res.json());
        
        console.log(data);
        
        });

