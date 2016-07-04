#-*- coding: UTF-8 -*-  

def versionCompare(v1,operator,v2):
	arr1 = v1.split('.')
	arr2 = v2.split('.')
	length = len(arr1)
	if(len(arr2) < length):
		length = len(arr2)

	flag = 0
	for i in range(0,length):
		if(int(arr1[i]) > int(arr2[i])):
			flag = 1
		elif(int(arr1[i]) < int(arr2[i])):
			flag = -1

	if('>' == operator):
		for i in range(0,length):
			if(int(arr1[i]) > int(arr2[i])):
				return True
			elif(int(arr1[i]) < int(arr2[i])):
				return False
		return False

	elif('>=' == operator):
		for i in range(0,length):
			if(int(arr1[i]) > int(arr2[i])):
				return True
			elif(int(arr1[i]) < int(arr2[i])):
				return False
		return True

	elif('==' == operator):
		for i in range(0,length):
			if(not int(arr1[i]) == int(arr2[i])):
				return False
			return True

	elif('<' == operator):
		for i in range(0,length):
			if(int(arr1[i]) < int(arr2[i])):
				return True
			elif(int(arr1[i]) > int(arr2[i])):
				return False
		return False
		
	elif('<=' == operator):
		for i in range(0,length):
			if(int(arr1[i]) < int(arr2[i])):
				return True
			elif(int(arr1[i]) > int(arr2[i])):
				return False
		return True
	
if __name__ == '__main__':
	v1 = '2.0.1'
	v2 = '2.0.2'
	v3 = '10.0.1'
	v4 = '3.1'

	print(versionCompare(v1,'<',v2))
	print(versionCompare(v1,'<=',v2))
	print(versionCompare(v1,'<',v3))

	print(versionCompare(v3,'>',v2))
	print(versionCompare(v3,'>=',v2))
	print(versionCompare(v1,'==',v1))

	print(versionCompare(v4,'>',v1))
	print(versionCompare(v4,'<',v3))