#!/usr/bin/python3
import sys

def add(com):
   """
   Ajoute une chaine de caractère (com) à la base de données des commentaires modérés
   """
   #with open(name, 'r', encoding='utf-8') as myfile:
   with open("BDD_insultes.txt", 'a', encoding='utf-8') as myfile:
       myfile.write(com)
       myfile.close()
    
#----------------------------------------------------------------------
if __name__ == "__main__" :
    arg=int(sys.argv[1])
    print(arg)
    commentaire=' '
    for i in range (2, arg+2):
        commentaire+=str(sys.argv[i])+' '
    commentaire+='\n'
    add(commentaire)
