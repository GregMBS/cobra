#! /bin/bash

sed -i '
s/saldo/balance/
s/Saldo/Balance/
s/SALDO/BALANCE/
s/nombre/name/
s/OldUser/Name/
s/NOMBRE/NAME/
s/deudor/debtor/
s/Deudor/Debtor/
s/DEUDOR/DEBTOR/
s/promesa/promise/
s/Promesa/Promise/
s/PROMESA/PROMISE/
s/pago/paid/
s/Payment/Paid/
s/PAGO/PAID/
s/fecha/date/
s/Fecha/Date/
s/FECHA/DATE/
s/monto/amount/
s/Monto/Amount/
s/MONTO/AMOUNT/
s/usuario/user/
s/Usuario/User/
s/USUARIO/USER/
s/contrase�a/password/
s/Contrase�a/Password/
s/CONTRASEñA/PASSWORD/
s/cuenta/account/
s/Cuenta/Account/
s/CUENTA/ACCOUNT/
s/gestion/agentcall/
s/Gestion/Agentcall/
s/GESTION/AGENTCALL/
' "$@"

