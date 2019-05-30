#! /bin/bash

sed -i '
s/balance/saldo/
s/Balance/Saldo/
s/BALANCE/SALDO/
s/name/nombre/
s/Name/Nombre/
s/NAME/NOMBRE/
s/debtor/deudor/
s/Debtor/Deudor/
s/DEBTOR/DEUDOR/
s/promise/promesa/
s/Promise/Promesa/
s/PROMISE/PROMESA/
s/paid/pago/
s/Paid/Pago/
s/PAID/PAGO/
s/date/fecha/
s/Date/Fecha/
s/DATE/FECHA/
s/amount/monto/
s/Amount/Monto/
s/AMOUNT/MONTO/
s/user/usuario/
s/User/Usuario/
s/USER/USUARIO/
s/password/contrase�a/
s/Password/Contrase�a/
s/PASSWORD/CONTRASEñA/
s/account/cuenta/
s/Account/Cuenta/
s/ACCOUNT/CUENTA/
s/agentcall/gestion/
s/Agentcall/Gestion/
s/AGENTCALL/GESTION/
' "$@"

