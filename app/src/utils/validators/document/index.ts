//https://github.com/carvalhoviniciusluiz/cpf-cnpj-validator
import cpf from './cpf'

export { cpf }

export function documentCleaner (value: string) {
  return cpf.strip(value)
}

export function documentValidator (value: string) {

  const document = documentCleaner(value)
  if (!document)
    return false

  if (document.length <= 11)
    return cpf.isValid(document)
}

export const validator = (joi: any) => ({
  type: 'document',
  base: joi.string(),
  messages: {
    'document.cpf': 'CPF inválido',
  },
  rules: {
    cpf: {
      validate (value: any, helpers: any, args: any, options: any) {
        if (!cpf.isValid(value)) {
          return helpers.error('document.cpf');
        }

        return value
      }
    }
  }
});

export default validator;
