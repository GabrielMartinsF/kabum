import axios, { AxiosResponse } from 'axios';

export function loadCep (cep: string) {
    return new Promise((resolve, reject) => {
        if (!cep)
            return null
        const _cep = cep.trim().replace(/[^0-9]/g, '');

        const url_cep = 'https://viacep.com.br/ws/' + _cep + '/json';

        // clear all headers axios to viacep
        axios.defaults.headers.common = null;

        axios.get(url_cep).then((response: AxiosResponse) => {
            resolve({
                cep: cep,
                logradouro: response.data.logradouro,
                bairro: response.data.bairro,
                estado: response.data.uf,
                cidade: response.data.localidade,
            })
        }).catch((error) => {
            console.error(error);
            reject(error)
        });
    })
}