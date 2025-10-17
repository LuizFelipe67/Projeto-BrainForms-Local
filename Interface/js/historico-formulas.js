window.API_URL = "http://localhost:8000";
 
 async function enviarHistorico(formulaId, valoresObj, resultadoObj) {
    const token = localStorage.getItem('token');
    if (!token) {
      console.warn('Sem token, não foi possível enviar histórico');
      return null;
    }

    const payload = {
      formula_id: formulaId,
      valores: valoresObj,
      resultado: resultadoObj
    };

    const res = await fetch(`${API_URL}/api/historico-formulas`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      body: JSON.stringify(payload)
    });

    if (!res.ok) {
      const txt = await res.text();
      console.error('Erro response', res.status, txt);
      throw new Error('Erro ao enviar histórico');
    }

    return await res.json();
  }
