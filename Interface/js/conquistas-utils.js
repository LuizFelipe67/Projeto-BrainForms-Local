// Utilitários compartilhados para conquistas
  window.API_URL = "http://localhost:8000";


(function () {
  async function carregarConquistasAPI() {
    try {
      const token = sessionStorage.getItem('token');
      if (!token) return [];

  const res = await fetch(`${API_URL}/api/alunos/conquistas`, {
        headers: { 'Authorization': `Bearer ${token}` }
      });

      if (!res.ok) {
        console.warn('carregarConquistasAPI: resposta não OK', res.status);
        return [];
      }

      return await res.json();
    } catch (e) {
      console.error('carregarConquistasAPI erro:', e);
      return [];
    }
  }
  

  function criarModalConquista() {
    if (document.getElementById('conquista-modal')) return; // já existe

    // inserir estilos do modal (apenas uma vez)
    if (!document.getElementById('conquista-modal-styles')) {
      const style = document.createElement('style');
      style.id = 'conquista-modal-styles';
      style.innerHTML = `
        #conquista-modal { font-family: Roboto, Arial, sans-serif; }
        #conquista-modal-box button { border: none; padding:10px 14px; border-radius:8px; cursor:pointer; font-weight:700; }
        #conquista-modal-open { background: #1d265e; color:white; }
        #conquista-modal-open:hover { background: #151344; transform: translateY(-1px); }
        #conquista-modal-close { background: #5E097E; color:white; }
        #conquista-modal-close:hover { background: #9036e4; transform: translateY(-1px); }
        #conquista-modal-icone { filter: none !important; }
      `;
      document.head.appendChild(style);
    }

    const modal = document.createElement('div');
    modal.id = 'conquista-modal';
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.background = 'rgba(0,0,0,0.6)';
    modal.style.display = 'flex';
    modal.style.justifyContent = 'center';
    modal.style.alignItems = 'center';
    modal.style.zIndex = '2000';

    modal.innerHTML = `
      <div id="conquista-modal-box" style="background:white;border-radius:12px;padding:20px;max-width:420px;width:92%;text-align:center;box-shadow:0 8px 30px rgba(0,0,0,0.4)">
        <img id="conquista-modal-icone" src="" alt="icone" style="width:90px;height:90px;border-radius:50%;object-fit:cover;margin-bottom:12px;background:#f0f0f0;filter:none;">
        <h3 id="conquista-modal-message" style="color:#5E097E;margin:0 0 8px 0;font-size:16px"></h3>
        <h4 id="conquista-modal-nome" style="color:#5E097E;margin:6px 0 8px 0;font-size:14px"></h4>
        <p id="conquista-modal-desc" style="color:#333;font-size:14px;margin:0 0 12px 0"></p>
        <p id="conquista-modal-status" style="font-weight:bold;margin:0 0 12px 0;color:#2b7a2b"></p>
        <div style="display:flex;gap:10px;justify-content:center;margin-top:8px">
          <button id="conquista-modal-open">Abrir conquistas</button>
          <button id="conquista-modal-close">Fechar</button>
        </div>
      </div>`;

    document.body.appendChild(modal);

    document.getElementById('conquista-modal-close').addEventListener('click', () => {
      modal.style.display = 'none';
      // remover do DOM para evitar acúmulo
      setTimeout(() => { try { modal.remove(); } catch(e){} }, 200);
    });
    document.getElementById('conquista-modal-open').addEventListener('click', () => {
      try { window.location.href = 'conquistas.html'; } catch (e) { console.error(e); }
    });
  }

  /**
   * Mostrar novas conquistas.
   * @param {Array} conquistas - lista completa de conquistas (do servidor)
   * @param {boolean} primeiraVez - se true, mostra todas concluidas na primeira vez
   * @param {Array|null} novasIds - opcional, array de ids (do backend) que foram recém-desbloqueadas
   */


  function mostrarNovasConquistasLocal(conquistas, primeiraVez = false, novasIds = null) {
    const conquistasAntigas = JSON.parse(sessionStorage.getItem('conquistasAnteriores')) || [];

    let novas = [];
    // Se backend informou IDs recém-desbloqueadas, use isso como fonte de verdade
    if (Array.isArray(novasIds) && novasIds.length) {
      const idSet = new Set(novasIds.map(i => Number(i)));
      novas = conquistas.filter(c => idSet.has(Number(c.id)));
    } else if (primeiraVez) {
      novas = conquistas.filter(c => c.concluida);
    } else {
      novas = conquistas.filter(c => c.concluida && !conquistasAntigas.some(ac => ac.id === c.id));
    }

    if (!novas.length) {
      // nenhuma nova, apenas atualiza o storage
      sessionStorage.setItem('conquistasAnteriores', JSON.stringify(conquistas));
      return;
    }

    // mostrar apenas a primeira conquista nova (aquela desbloqueada naquele momento)
    const c = novas[0];
    criarModalConquista();
    const modal = document.getElementById('conquista-modal');
    if (!modal) return; // falha segura

  const icone = document.getElementById('conquista-modal-icone');
  const messageEl = document.getElementById('conquista-modal-message');
  const nomeEl = document.getElementById('conquista-modal-nome');
  const descEl = document.getElementById('conquista-modal-desc');
  const statusEl = document.getElementById('conquista-modal-status');

  icone.src = c.icone || 'Imagens/perfilDefault.png';
  // Aplicar cor de fundo da conquista (igual ao painel) e garantir imagem colorida
  try {
    icone.style.background = c.cor || '#D9D9D9';
    icone.style.filter = 'none';
  } catch (e) {}
  // Mostrar apenas a frase solicitada
  messageEl.textContent = `🎉 Parabéns por concluir sua ${c.id}° conquista: ${c.name}`;
  // ocultar campos que não são necessários
  nomeEl.style.display = 'none';
  descEl.style.display = 'none';
  statusEl.style.display = 'none';

  modal.style.display = 'flex';

    // atualizar storage marcando todas as conquistas atuais como anteriores (consideradas lidas)
    sessionStorage.setItem('conquistasAnteriores', JSON.stringify(conquistas));
  }

  window.carregarConquistasAPI = carregarConquistasAPI;
  window.mostrarNovasConquistasLocal = mostrarNovasConquistasLocal;
})();
