(1) '/api/clients' = Aqui se cria o usuário no banco efetivamente. São informações básicas (cpfCnpj, nome da empresa, nome do proprietário, senha, email e telefones)
(2) '/api/step-2' = Update no user com endereço
(3) '/api/step-3' = Update no user com o object quiz (codigo, dias_semana, turnos)
(4) '/api/step-4' = Etapa que conclui o cadastro do usuário. São informações de upload de documentos e dados do sócio (cpf_socio, data_nascimento_socio, primeiro_nome_socio, ultimo_nome_socio, foto_documento, foto_endereco, foto_estabelecimento_fachada, foto_estabelecimento_interior)





'/api/clients/registration-status/' = Request para verificar o status do CNPJ/CPF do usuário

//Define o status (ativo, cliente_base, sem_registros, parcial_sms, parcial_sms_ativo, cadastro_parcial, parcial_quiz, bloqueado, analise)

'/api/valida-cpf' = verifica primeiro nome + último nome + data de nascimento + CPF na receita federal



//
| 0-  Tem cadastro na base = dbClient
| 1-  Sem registro  = noRegister
| 2 - Ativação SMS Pendente  = confirmation
| 3 - Cadastro em Análise  = review
| 4 - Cadastro Bloqueado =  blocked
| 5 - Cadastro Cancelado = canceled
| 6 - Cadastro na etapa do Contato = contact
| 7 - Cadastro na etapa da Empresa = company
| 8 - Cadastro na etapa da Logistica = logistic
| 9 - Cadastro na Etapa de Envio de Documento = documents
| 10 - Cadastro dentro do prazo para reanalise = reanalysis
| 11 - Ativo  = active

