numero = 72987060000000000000
anni = numero // (365 * 24 * 60) % 360
giorni = numero // (24 * 60)
ore = (numero // 60) % 24  
minuti = numero % 60  
print(f"{numero} corrisponde a {anni} anni {giorni} giorni, {ore:02d}:{minuti:02d}")