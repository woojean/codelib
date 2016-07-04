/* 归并排序 */

#include "stdio.h"
#include "stdlib.h"

#define LEN 26

void  Merge( int arr[], int tmpArray[], int lBegin, int rBegin, int rEnd )
{
  int i, lEnd, len, tmpPos;
  lEnd = rBegin - 1;
  tmpPos = lBegin;
  len = rEnd - lBegin + 1;
  
      /* main loop */
  while( lBegin <= lEnd && rBegin <= rEnd ){
    if( arr[ lBegin ] <= arr[ rBegin ] ){
      tmpArray[ tmpPos++ ] = arr[ lBegin++ ];
    }
    else{
      tmpArray[ tmpPos++ ] = arr[ rBegin++ ];
    }
  }
  while( lBegin <= lEnd ){
    tmpArray[ tmpPos++ ] = arr[ lBegin++ ];
  }

  while( rBegin <= rEnd ){
    tmpArray[ tmpPos++ ] = arr[ rBegin++ ];
  }

  for( i = 0; i < len; i++, rEnd-- ){
    arr[ rEnd ] = tmpArray[ rEnd ];
  }
}


void MSort( int arr[ ], int tmpArray[ ], int left, int right )
{
  int mid;
  if( left < right )
  {
    mid = ( left + right ) / 2;
    MSort( arr, tmpArray, left, mid );
    MSort( arr, tmpArray, mid + 1, right );
    Merge( arr, tmpArray, left, mid + 1, right );
  }
}
       
       
void  MergeSort( int arr[ ], int len )
{
  int *tmpArray;
  tmpArray = malloc( len * sizeof( int ) );
  if( tmpArray != NULL )
  {
    MSort( arr, tmpArray, 0, len - 1 );
    free( tmpArray );
  }
  else
    printf( "No space for tmp array!!!" );
}


int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i;

  printf("array before sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  
  MergeSort(arr,LEN);

  printf("\narray after sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]);
  }
  printf("\n");
}

